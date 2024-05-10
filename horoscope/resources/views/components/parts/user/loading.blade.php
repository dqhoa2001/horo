{{-- ローディングの表示 --}}
<div class="spinner"  v-if="isLoading">
	<div class="double-bounce1"></div>
	<div class="double-bounce2"></div>
	<p class="double-text">
		注文処理中です。<br>
		このままブラウザを閉じずにお待ちください。
	</p>
</div>