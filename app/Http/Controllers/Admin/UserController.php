<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Http\Requests\{User\StoreUserRequest, User\UpdateUserRequest};
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class UserController extends DashboardController
{
    public function __construct(
        public UserService $userService,
        public UserRepositoryInterface $userRepository,
        public RoleRepositoryInterface $roleRepository,

    )
    {
        parent::__construct($userService);
        $this->storeRequestClass = new StoreUserRequest();
        $this->updateRequestClass = new UpdateUserRequest();
        $this->indexView = 'users.index';
        $this->createView = 'users.create';
        $this->editView = 'users.edit';
        $this->sharedData = [
            'roles' => $this->roleRepository->all(),
        ];
        $this->showView = 'users.show';
        $this->usePagination = true;
        $this->useFilter = true;
        $this->partialFolder = 'users';
        $this->successMessage = 'Process success';
    }

    public function changePasswordForm(): View|Factory|Application
    {
      return view('admin.users.change-password');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $data =$request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $this->userService->changePassword($data);
        return to_route("admin.dashboard")->with("success", $this->successMessage);
    }



}
