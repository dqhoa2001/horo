@extends('layouts.user.app')

@section('content')
<div class="container">
    <x-parts.basic_card_layout>
        <x-slot name="cardHeader">
            <h4 class="my-2">一覧：{{ $familyHoroscopes->total() . '件中' . $familyHoroscopes->firstItem() . '-' . $familyHoroscopes->lastItem() }}件</h4>
            <a href="{{ route('user.family_horoscopes.create') }}" class="btn btn-primary">作成する</a>
        </x-slot>
        <x-slot name="cardBody">
            <x-parts.basic_table_layout>
                <x-slot name="thead">
                    <tr>
                        <th scope="col" class="text-nowrap">タイトル</th>
                        <th scope="col" class="text-nowrap">作成日</th>
                        <th scope="col" class="text-nowrap">編集</th>
                        <th scope="col" class="text-nowrap">削除</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @if($familyHoroscopes->isNotEmpty())
                        @foreach($familyHoroscopes as $familyHoroscope)
                            <tr>
                                <td class="text-nowrap px-2"><a href="{{ route('user.family_horoscopes.show', $familyHoroscope) }}">{{ $familyHoroscope->title }}</a></td>
                                <td class="text-nowrap px-2">{{ $familyHoroscope->created_at }}</td>
                                <td class="text-nowrap px-2"><a href="{{ route('user.family_horoscopes.edit', $familyHoroscope) }}" class="btn btn-sm btn-outline-secondary">編集</a></td>
                                <td class="text-nowrap px-2">
                                    <form action="{{ route('user.family_horoscopes.destroy', $familyHoroscope) }}" method="POST">
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
                {{ $familyHoroscopes->links('pagination::bootstrap-4') }}
            </div>
        </x-slot>
    </x-parts.basic_card_layout>
</div>
@endsection
