<style>
	
	li::marker {
		display: none;
	}

	form .text-danger {
		font-weight: bold;
		font-size: 12px;
		margin-top: 7px;
		display: block;
	}

	.input-group-text {
		width: 38px;
		text-align: center;
	}

	.ajs-button {
		border: 0px;
		font-weight: bold;
	}

	.ajs-cancel {
		background: rgb(209, 56, 56);
		color: #fff;
	}
	.edit{
		margin: 0px 5px;
	}
	.delete{
		margin: 0px 5px;
	}
	.view{
		margin: 0px 5px;
	}
	#form {
		background-color: #eff2f7;
		padding: 30px 20px;
		border-radius: 7px;
	}
	.delete_selected_item_style{
		background: red;
		font-weight:bold;
		padding: 10px 10px;
		color: #FFF;
		position:relative;
		top: 2px;
		margin: 0px auto;
		display:block;
		text-align: center;
	}
	.delete_selected_item_style_title_head{
		color: red;
		text-decoration: underline;
	}

	.breadcrumb .active{
		color: #727bb7;
		font-weight: bold;
	}
	.form_bordred_sections{
		border: 5px solid #fff;
		/* opacity: 0.5; */
		padding: 20px 15px;
		border-radius: 15px;
		margin: 5px 0px 25px;
	}

	.app-search input{
		width: 270px;
		text-align: center;
	}

	.dt_btn{
		margin: 1px 2px;
	}

	.dropdown-divider{
		opacity: .2;
		width: 75%;
		margin: 8px auto;
	}

	.metismenu li{
		margin: 4px 0px;
	}

	/* body[data-sidebar="dark"] .mm-active .active, body[data-sidebar="colored"] .mm-active .active{
		color: #2a3042 !important;
		background: #e9e9e9;
		font-weight: bold;
	}

	body[data-sidebar="dark"].vertical-collpsed .vertical-menu #sidebar-menu ul li.mm-active .active, body[data-sidebar="colored"].vertical-collpsed .vertical-menu #sidebar-menu ul li.mm-active .active{
		color: #2a3042 !important;
		background: #e9e9e9;
		font-weight: bold;
	}

	body[data-sidebar="colored"] .mm-active>a{
		background: #fff;
		color: #34394b !important;
		font-weight: bold;
	}

	body[data-sidebar="colored"] .mm-active>a i{
		color: rgb(255, 119, 0) !important;
	}

	body[data-sidebar="colored"] .mm-active>a:hover i{
		font-size: 28px !important;
	} */






	{{--  start calc  --}}
	@import url("https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@100..800&display=swap");
	.calculator {
		position: relative;
		border-radius: 20px;
		box-shadow: 15px 15px 20px rgba(0, 0, 0, 0.1), -15px -15px 20px #fffb;
		direction: ltr;
		font-weight: bold;
	}
	.calculator .buttons {
		position: relative;
		display: grid;
	}
	.calculator .buttons #value {
	position: relative;
		grid-column: span 4;
		user-select: none;
		overflow: none;
		width: 100%;
		text-align: end;
		color: #5166d6;
		height: 100px;
		line-height: 100px;
		box-shadow: inset 5px 5px 20px rgba(0, 0, 0, 0.1), inset -5px -5px 20px #fff;
		border-radius: 10px;
		margin-bottom: 12px;
		padding: 0 20px;
		font-size: 2em;
		font-weight: 500;
	}
	.calculator .buttons span {
		position: relative;
		padding: 10px;
		box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 20px #fff;
		margin: 10px;
		cursor: pointer;
		user-select: none;
		min-width: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
		font-size: 1.2em;
		color: #666;
		border: 2px solid #edf1f4;
		box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px #fff;
		border-radius: 10px;
	}
	.calculator .buttons span:active {
		box-shadow: inset 5px 5px 20px rgba(0, 0, 0, 0.1), inset -5px -5px 10px #fff;
		color: #f44336;
	}
	.calculator .buttons span#clear {
	grid-column: span 2;
		background: #f44336;
		color: #fff;
		border: 2px solid #edf1f4;
	}
	.calculator .buttons span#plus {
	grid-row: span 2;
		background: #31a935;
		color: #fff;
		border: 2px solid #edf1f4;
	}
	.calculator .buttons span#equal {
		background-color: #2196f3;
		color: #fff;
	}
	.calculator .buttons span#clear:active,
	.calculator .buttons span#plus:active,
	.calculator .buttons span#equal:active {
	box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px #fff,
		inset 5px 5px 10px rgba(0, 0, 0, 0.1);
	}

	{{--  end calc  --}}
</style>










@if (app()->getLocale() == 'en')
	<style>
		.card-title span{
			float: right;
		}
		form .require_input {
			color: red;
			font-size: 8px;
			float: right;
			top: 6px;
			position: relative;
			right: 3px;
		}

	</style>
@elseif (app()->getLocale() == 'ar')
	<style>
		.card-title span{
			float: left;
		}

		form .require_input {
			color: red;
			font-size: 8px;
			float: left;
			top: 6px;
			position: relative;
			left: 3px;
		}
	</style>
@endif
