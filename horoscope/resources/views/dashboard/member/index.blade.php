<x-layout>
    <h1>@lang('title.member_list')</h1>
    <x-toast />
    <x-table>
        <x-slot name='header'>
            <tr>
                <th class="min-vw">No</th>
                <th>@lang('title.name')</th>
                <th>@lang('title.email')</th>
                <th>@lang('title.phone')</th>
                <th>@lang('title.day_of_birth')</th>
                <th>@lang('title.verified_at')</th>
                <th colspan="2" class="text-center">@lang('title.action')</th>
            </tr>
        </x-slot>
        <x-slot name='body'>
            @if (isset($members) && !empty($members))
                @foreach ($members as $index => $member)
                    <tr>
                        <td>{{ $members->firstItem() + $index }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->day_of_birth ? $member->day_of_birth->format('m/d/Y') : '#' }}</td>
                        <td>{{ $member->verified_at ? $member->verified_at->format('m/d/Y') : '#' }}</td>
                        <td class="text-center">
                            <a href={{ route('dashboard.member-view', $member->id) }}>
                                <button type="button" class="btn btn-success">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="#">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $id = $member->id }}"
                                    data-action={{ $action = route('dashboard.member-delete', $member->id) }}>
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    @include('includes.modal')
                @endforeach
            @endif
        </x-slot>
        <x-slot name='paginate'>
            @include('includes.paginate', ['paginate' => $members])
        </x-slot>
    </x-table>
</x-layout>
