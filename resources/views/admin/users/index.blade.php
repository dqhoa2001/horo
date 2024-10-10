<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">会員一覧：{{ $users->total() . '件中' . $users->firstItem() . '-' . $users->lastItem() }}件</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">会員ID</th>
                                <th scope="col" class="text-nowrap">種別</th>
                                <th scope="col" class="text-nowrap" style="width:100px;">製本購入済み</th>
                                <th scope="col" class="text-nowrap">ユーザー名</th>
                                <th scope="col" class="text-nowrap">メールアドレス</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @include('components.parts.search_box',[
                            'users'=> \Request::get('searchName')?? '',
                            'userEmail' => \Request::get('searchEmail') ?? '',
                            'general' => \Request::get('general') ?? '',
                            'influencer' => \Request::get('influencer') ?? '',
                            'withdraw' => \Request::get('withdraw') ?? '',
                            'userBookbindings' => \Request::get('userBookbindings') ?? '',
                            'route' => 'admin.users.index',
                            ])
                            @if($users->isNotEmpty())
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-nowrap px-2">{{ $user->id }}</td>
                                        <td class="text-nowrap px-2">{{ \App\Models\User::TYPE[$user->member_type] ?? \App\Models\User::GENERAL }}</td>
                                        <td class="text-nowrap text-center">
                                            {{ $user->isHasBookbinding() ? '◯' : '' }}
                                        </td>
                                        <td class="text-nowrap px-2">
                                            <a href="{{ route('admin.users.edit', $user) }}">{{ $user->full_name }}
                                                @if($user->deleted_at)
                                                    （退会済み）
                                                @endif
                                            </a>
                                        </td>
                                        <td class="text-nowrap px-2">{{ $user->email }}</td>
                                        <td class="text-nowrap px-2">
                                            @if(!$user->deleted_at)
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('本当に削除しますか？')"
                                                    >削除</button>
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </x-slot>
                    </x-parts.basic_table_layout>
                    <div class="row justify-content-center">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
</x-admin.layout>
