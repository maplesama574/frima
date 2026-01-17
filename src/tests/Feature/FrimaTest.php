<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Item;
use App\Models\Favorite;

class FrimaTest extends TestCase
{use RefreshDatabase;
    
/**ログアウト */
public function test_user_can_logout()
{
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
}

/**商品取得機能 */
public function test_all_items_are_displayed()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $items = Item::factory()->count(3)->create();

    $response = $this->get('/');

    foreach ($items as $item) {
        $response->assertSee($item->name);
    }
}

public function test_sold_item_is_marked_as_sold()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $item = Item::factory()->create([
        'is_sold' => true,
    ]);

    $response = $this->get('/');

    $response->assertSee('Sold');
}

public function test_own_items_are_not_displayed()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    // 自分の商品
    Item::factory()->create([
        'user_id' => $user->id,
        'name' => '自分の商品',
    ]);

    // 他人の商品
    $otherUser = User::factory()->create();
    Item::factory()->create([
        'user_id' => $otherUser->id,
        'name' => '他人の商品',
    ]);

    $response = $this->get('/');

    $response->assertDontSee('自分の商品');
    $response->assertSee('他人の商品');
}

/**マイリスト*/
public function test_only_liked_items_are_displayed()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $likedItem = Item::factory()->create(['name' => 'いいね商品']);
    $notLikedItem = Item::factory()->create(['name' => '非いいね商品']);

    Favorite::create([
        'user_id' => $user->id,
        'item_id' => $likedItem->id,
    ]);

    $response = $this->get('/');

    $response->assertSee('いいね商品');
    $response->assertDontSee('非いいね商品');
}

public function test_guest_user_sees_no_items()
{
    $items = Item::factory()->count(3)->create();

    $response = $this->get('/');

    foreach ($items as $item) {
        $response->assertDontSee($item->name);
    }
}

}
