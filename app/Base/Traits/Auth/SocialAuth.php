<?php

namespace App\Base\Traits\Auth;
use App\Base\Traits\Response\SendResponse;
use Core\Marketer\Marketer\Models\Marketer;
use Core\Marketer\Marketer\Models\SocialAccount;
use Core\Marketer\Marketer\Resources\MarketerResource;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

trait SocialAuth
{
    use SendResponse;

    protected Model $model;
    protected string $guard;
    protected $resource;

    public function setModel(Model $model){
        $this->model = $model;
    }

    public function setGuard(string $guard){
        $this->guard = $guard;
    }

    public function setResource($resource){
        $this->resource = $resource;
    }

    public function providerRedirection(String $provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        return Socialite::driver($provider)->redirect();
    }

    public function setProviderCallback(String $provider,Request $request)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = $this->model->firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );

        Auth::guard($this->guard)->setUser($userCreated);

        $token = auth()->guard($this->guard)->user()->createToken($this->guard)->plainTextToken;

        $userCreated->socialAccounts()->updateOrCreate(
            [
                'provider_name' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar(),
            ]
        );

        return $this->sendResponse(
            [
                'user' => new $this->resource(auth()->guard($this->guard)->user()),
                'token' => $token,
            ],
            'تم تسجيل الدخول بنجاح',
            true,
            200
        );    
    }
    

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}