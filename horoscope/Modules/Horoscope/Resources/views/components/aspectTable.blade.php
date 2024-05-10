<table class="aspect-explain border border-4" style="width: 250px">
    @foreach ($degreeData->get('aspect_line') as $fromAspect => $aspect)
        <tr class="border border-2 h-auto">
            <td class="border" rowspan={{ $aspect->get('to')->count() + 1 }}>
                <p class="m-0 text-center">
                    {{ $planets->where('id',$aspect->get('from')->first()->get('planet_num'))->pluck('name_en')->first() }}
                </p>
            </td>
        </tr>
        @foreach ($aspect->get('to') as $aspectTo)
            <tr class="border border-2">
                <td>
                    <p class="m-0 text-center">
                        {{ $planets->where('id', $aspectTo->get('planet_num'))->pluck('name_en')->first() }}
                    </p>
                </td>
                <td>
                    <p class="m-0 text-center">
                        {{ $aspectTo->get('case') }}
                    </p>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
