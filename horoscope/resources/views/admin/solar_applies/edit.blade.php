<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center" id="admin-appraisal-edit">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">{{ $solarApply->withTrashedApplyReference()->full_name }} SOLARさんの鑑定編集</h4>
                    <div class="d-flex align-items-center">
                        <label for="editEnable" class="me-3">
                            <input type="checkbox" id="editEnable" name="editEnable" value="1" v-model="editEnable">
                            編集を許可する
                        </label>
                    </div>
                </x-slot>
                <x-slot name="cardBody">
                    <form action="{{ route('admin.solar_applies.update', $solarApply) }}" method="POST" onsubmit="return false;">
                        @csrf
                        @method('PATCH')
                            <div class="form-body">
                                <div class="row mb-3">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">Solar Year</label>
                                    </div>
                                    <div class="col-md-6 align-self-center" style="width: 165px">
                                        <input  name="solar_date" id="solar_date"
                                                value="{{ old('solar_date', $solarApply->solar_date )}}"
                                                class="form-control form-control-date @error('solar_year') is-invalid @enderror"
                                                :disabled="!editEnable">
                                        <!-- @include('components.form.error', ['name' => 'birthday', 'class' => 'text-danger']) -->
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                        <div class="col-md-5 text-md-end">
                                            <label for="last_name" class="col-form-label">生まれた場所</label>
                                        </div>
                                        <div class="col-md-6 align-self-center">
                                            <input type="text" name="birthday_prefectures" id="birthday_prefectures"
                                                    value="{{ old('birthday_prefectures', $solarApply->user->birthday_prefectures) }}"
                                                    class="form-control form-control-date @error('birthday_prefectures') is-invalid @enderror"
                                                    disabled
                                                    @input="handleInputChange">
                                            @include('components.form.error', ['name' => 'birthday_prefectures', 'class' => 'text-danger'])
                                        </div>
                            </div>

                            <div class="row mb-3">
                                    <div class="col-md-6 mx-auto">
                                        <div id="map" style="height: 250px; width:100%"></div>
                                    </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5 text-md-end">
                                    <label for="last_name" class="col-form-label">経度</label>
                                </div>
                                <div class="col-md-6 align-self-center">
                                    <input id="map-longitude" disabled type="text" value="{{ $solarApply->user->longitude }}" style="color:#a1a1a6;">
                                    <input id="lng" name="longitude" type="hidden" value="{{ $solarApply->user->longitude }}">
                                    @error('longitude')
                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-5 text-md-end">
                                    <label for="last_name" class="col-form-label">緯度</label>
                                </div>
                                <div class="col-md-6 align-self-center">
                                    <input id="map-latitude" disabled type="text" value="{{ $solarApply->user->longitude }}" style="color:#a1a1a6;">
                                    <input id="lat" name="latitude" type="hidden" value="{{ $solarApply->user->longitude }}">
                                    @error('latitude')
                                        <span style="color: red" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        <div class="text-center my-4">
                            <button type="button" class="btn btn-dark" :disabled="!editEnable" onClick="submit();">
                                更新する
                            </button>
                        </div>
                    </form>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
    <script src="https://unpkg.com/vue@3"></script>

    <script>
        Vue.createApp({
            data() {
                return {
                    marker: null,
                    map: null,
                    geocoder: new google.maps.Geocoder(),
                    editEnable: false,
                }
            },
            methods: {
                handleInputChange() {
                    let birthplace1 = document.getElementById('birthday_prefectures').value;
                    let address = birthplace1;
                    this.updateMapAndMarker(address);
                },
                updateMapAndMarker(address) {
                    this.geocoder.geocode({ 'address': address }, (results, status) => {
                        if (status === 'OK') {
                            if (!this.map) {
                                this.map = new google.maps.Map(document.getElementById('map'), {
                                    center: results[0].geometry.location,
                                    zoom: 10,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    scrollwheel: false,
                                    disableDoubleClickZoom: true,
                                    draggable: false,
                                });
                            } else {
                                this.map.setCenter(results[0].geometry.location);
                            }

                            if (!this.marker) {
                                this.marker = new google.maps.Marker({
                                    position: results[0].geometry.location,
                                    map: this.map,
                                    title: 'here',
                                });
                            } else {
                                this.marker.setPosition(results[0].geometry.location);
                            }

                            const changeLng = results[0].geometry.location.lng();
                            const changeLat = results[0].geometry.location.lat();
                            document.getElementById('map-longitude').value = changeLng;
                            document.getElementById('map-latitude').value = changeLat;
                            document.getElementById('lng').value = changeLng;
                            document.getElementById('lat').value = changeLat;
                        } else {
                            console.error('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                },
            },
            mounted() {
                // 初期住所をサーバーサイドで設定
                let initialAddress = @json($solarApply->user->birthday_prefectures);
                this.updateMapAndMarker(initialAddress);
            }
        }).mount('#admin-appraisal-edit');
    </script>

</x-admin.layout>
