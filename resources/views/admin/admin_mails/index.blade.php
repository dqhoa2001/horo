<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">管理者メール一覧：{{ $adminMails->total() . '件中' . $adminMails->firstItem() . '-' . $adminMails->lastItem() }}件</h4>
                    <a href="{{ route('admin.admin_mails.create') }}" class="btn btn-primary">作成する</a>
                </x-slot>
                <x-slot name="cardBody">
                    <p class="text-danger">※作成できるのは10件までです</p>
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">メールアドレス</th>
                                <th scope="col" class="text-nowrap">作成日</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @if($adminMails->isNotEmpty())
                                @foreach($adminMails as $adminMail)
                                    <tr>
                                        <td class="text-nowrap px-2"><a href="{{ route('admin.admin_mails.edit', $adminMail) }}">{{ $adminMail->email }}</a></td>
                                        <td class="text-nowrap px-2">{{ $adminMail->created_at }}</td>
                                        <td class="text-nowrap px-2">
                                            <form action="{{ route('admin.admin_mails.destroy', $adminMail) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('本当に削除しますか？')"
                                                >削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </x-slot>
                    </x-parts.basic_table_layout>
                    <div class="row justify-content-center">
                        {{ $adminMails->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
</x-admin.layout>
