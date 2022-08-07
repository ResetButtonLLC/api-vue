<?php

namespace App\Http\Controllers;

use App\Helpers\DBHelper;
use App\Models\User;
use App\Services\Import\FeedParser;
use App\Services\Import\Savers\TestDBSaver;
use App\Services\Import\Savers\TestSaver;
use App\Services\Import\TypeChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function login()
    {

        $user = User::where('email','test@test')->first();

        if(!$user) {
            $user = User::factory([
                'name' => 'Test',
                'email' => 'test@test',
                'avatar' => '/img/test.png',
                'role' => USER::ROLE_ADMIN
            ])->create();
        }

        auth()->login($user,true);

        return redirect()->intended("/");
    }

    public function test(Request $request)
    {
        $saver = new TestDBSaver();
        $typeChecker = new TypeChecker();
        $parser = new FeedParser($saver, $typeChecker);

        $file = 'feed.csv';
        //$file = 'allo2.xml'; //google
        //$file = 'allo.xml'; //yandex

        DBHelper::fresh('Тестовое бд', 'для сейвера');
        $parser->process(public_path($file), ['availability' => 'availability', 'description' => 'description']);

        //dd($parser->getParsedElements());
    }
}
