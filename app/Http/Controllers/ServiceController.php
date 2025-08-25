<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ServiceController extends Controller
{
    public function index() {
        return Inertia::render('Service', ['users' => $this->getUsersWithService()]);
    }

    public function getUsers() {
        return User::all(['id', 'name', 'email', 'type', 'service_id']);
    }

    public function fetchUserService(Collection $collection) {
        $users = $collection->map(function($item) {

            $item['service'] = Service::find($item->service_id)->only(["name"]);

            return $item;
        });

        return $users;
    }

    public function getUsersWithService() {
        return $this->fetchUserService($this->getUsers());
    }
}
