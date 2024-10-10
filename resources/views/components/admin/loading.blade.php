{{-- ローディングの表示 --}}
<div class="spinner"  v-if="isLoading">
	<div class="double-bounce1"></div>
	<div class="double-bounce2"></div>
	<p class="double-text">
		ブラウザを閉じたりせず、<br>
		しばらくお待ちください。
	</p>
</div>