<?php
    include './partials/header.php';
    // require 'vendor/autoload.php';
?>

<?php
    // pdt-text include './partials/announcement.php';
?>

<?php 
    // include './partials/navigation-2.php'; 
?>

<?php 
    // include './partials/cover-section.php'; 
?>

<link rel="stylesheet" href="lib/slick/slick.css">
<link rel="stylesheet" href="lib/select2/select2.min.css">
<!-- <link rel="stylesheet" href="css/select2-restyle.css"> -->



<style>
    .page-wrapper {
        padding: 20px 20px 50px 20px;
        min-height: 100vh;
        width: 100%;
        background: rgba(29, 37, 52, .8);
    }
</style>

<!-- Sizes -->
<style>
	.size-wrapper {
		margin-top: 20px;
		margin-bottom: 10px;
	}
	.sizes-label {
		margin-bottom: 15px;
		font-size: 15px;
	}
	.size-options {
		display: flex;
		flex-flow: row nowrap;
		width: 100%;
	}

	.size-option {
		width: 50px;
		height: 40px;
		color: #fff;
		background: #FFFFFF1A;

		font-size: 16px;
		border-radius: 10px;
		margin-right: 10px;
		
		cursor: pointer;
		text-align: center;
		display: flex;
		flex-flow: row nowrap;
		align-items: center;
		justify-content: center;
	}
	.size-option.selected {
		background: #FEFA6A;
		color: #111111;
	}
</style>


<div class='page-wrapper'>


	<?php
        include './header-with-cart.php';
    ?>
	

	<style>
		.pdt-sold {
			font-size: 18px;
			font-weight: 600;
			color: rgba(76, 225, 63, 1);
			margin-bottom: 10px;
		}
		.pdt-serial {
			font-size: 18px;
			font-weight: 600;
			color: rgba(254, 250, 106, 1);
			margin-bottom: 10px;
		}
		.pdt-name {
			font-size: 25px;
			line-height: 1.5;
			color: #fff;
			margin-bottom: 20px;
		}
		.pdt-text {
			padding-top: 23px;
		}
		.pdt-text p {
			font-size: 16px;
			line-height: 1.7;
			color: rgba(255, 255, 255, 0.8);
		}
		.pdt-price {
			display: flex;
			flex-flow: row nowrap;
			align-items: center;
		}
		.sale-price {
			font-size: 30px;
			line-height: 1.388888;
			margin-right: 10px;
		}
		.regular-price {
			font-size: 23px;
			line-height: 1.388888;
			text-decoration: line-through;
		}
		/* label */
		.input-label {
			width: 105px;
			justify-content: center;
			-ms-align-items: center;
			align-items: center;
		}
		/* select */
		.select-wrapper {
			width: calc(100% - 105px);
			border: 1px solid #e6e6e6;
		}
		.p-b-10, .p-tb-10, .p-all-10 {
			padding-bottom: 10px;
		}
		.size-203 {
			width: 105px;
		}
	  	.btns-group-bottom {
			display: flex; 
			flex-flow: column nowrap; 
		}
      	/* Number input */
	  	.wrap-num-product {
			width: 140px;
			height: 45px;
			border: 1px solid #e6e6e6;
			border-radius: 3px;
			overflow: hidden;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type=number]{
			-moz-appearance: textfield;
		}
		.m-r-20, .m-lr-20, .m-all-20 {
			margin-right: 20px;
		}
		.cl8 {
			color: #555;
		}

		.btn-num-product-up, .btn-num-product-down {
			width: 45px;
			height: 100%;
			cursor: pointer;
			background-color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		input.num-product {
			-moz-appearance: textfield;
			appearance: none;
			-webkit-appearance: none;
			border: none;
			outline: none;
		}

		.mtext-104 {
			font-size: 16px;
			line-height: 1.6;
		}
		.cl3 {
			color: #666;
		}
		.num-product {
			width: calc(100% - 90px);
			height: 100%;
			border-left: 1px solid #e6e6e6;
			border-right: 1px solid #e6e6e6;
			background-color: #f7f7f7;
		}
		.txt-center {
			text-align: center;
		}
		.wrap-num-product  {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			/* width: 100%; */
			
			flex-wrap: wrap;

			margin-top: 10px;
			margin-bottom: 10px;
			margin-right: 20px;

			width: 140px;
			height: 45px;
			overflow: hidden;

			border-width: 1px 1px 1px 1px;
			border-style: solid;
			border-color: #F0F0F0;
			background: transparent;
			border-radius: 1000px;
		}
		.btn-num-product-up, .btn-num-product-down {
			background: transparent;
		}
		.btn-num-product-up {
			border-left: 1px solid #F0F0F0;
		}
		.btn-num-product-down {
			border-right: 1px solid #F0F0F0;
		}
		input.num-product {
			background: transparent;
			color: #fff;
		}
		.btns {
			display: flex;
			flex-direction: row;
			margin-top: 20px;
		}
		.add-to-cart-btn {
			font-size: 16px;
			width: 145px;
			height: 50px;
			padding: 16px 20px 16px 20px;
			gap: 10px;
			border-radius: 1000px;
			border: 1px solid #FFFFFF4D;
			margin-right: 10px;
			cursor: pointer;

			display: flex;
			align-items: center;
			justify-content: center;
		}
		.buy-now-btn {
			font-size: 16px;
			width: 145px;
			height: 50px;
			padding: 16px 20px 16px 20px;
			gap: 10px;
			border-radius: 1000px;
			background: #FEFA6A;
			border: 1px solid #FEFA6A;
			color: #111111;
			font-weight: 600;
			cursor: pointer;

			display: flex;
			align-items: center;
			justify-content: center;
		}


		.error-text {
            color: #ff6060;
            font-size: 12px;
            line-height: 20px;
            padding: 15px 0 15px;
        }

		@media screen and (min-width: 1280px) {
			.shop-section-outer {
				max-width: 1400px;
				margin: 0px auto;
			}
			.btns-group-bottom {
				display: flex;
				flex-direction: row;
			}
			.btns {
				margin-top: 10px;
			}
		}
	</style>

    <style>
		.expand-arrow {
			position: absolute;
			top: 10px;
			right: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			height: 40px;
			background-color: #fff;
			color: #1d1d1d;
			border-radius: 50%;
		}
      	/* flex */
      	.flex-r-m {
			justify-content: flex-end;
			-ms-align-items: center;
			align-items: center;
		}
		.flex-sb {
			justify-content: space-between;
		}
		.flex-w {
			-webkit-flex-wrap: wrap;
			-moz-flex-wrap: wrap;
			-ms-flex-wrap: wrap;
			-o-flex-wrap: wrap;
			flex-wrap: wrap;
		}
		.flex-w, .flex-l, .flex-r, .flex-c, .flex-sa, .flex-sb, .flex-t, .flex-b, .flex-m, .flex-str, .flex-c-m, .flex-c-t, .flex-c-b, .flex-c-str, .flex-l-m, .flex-r-m, .flex-sa-m, .flex-sb-m, .flex-col-l, .flex-col-r, .flex-col-c, .flex-col-str, .flex-col-t, .flex-col-b, .flex-col-m, .flex-col-sb, .flex-col-sa, .flex-col-c-m, .flex-col-l-m, .flex-col-r-m, .flex-col-str-m, .flex-col-c-t, .flex-col-c-b, .flex-col-c-sb, .flex-col-c-sa, .flex-col-l-sb, .flex-col-r-sb, .flex-row, .flex-row-rev, .flex-col, .flex-col-rev, .dis-flex {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			/* width: 100%; */
		}


		
    </style>


	<!-- SLICK SLIDER -->
	<style>
		
		@media (min-width: 1400px) {
			.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
				max-width: 1140px;
			}
		}
		.slick-slide img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		.wrap-slick3 {
			display: flex;
			flex-flow: column-reverse nowrap;
			position: relative;
		}

		.slick3 {
			width: 100%;
		}
		.item-slick3.slick-active {
			width: 100%;
		}
		.pic-wrap.pos-relative {
			overflow: hidden;
			height: 500px;
			object-fit: cover;
			border-radius: 25px 25px 0 0;
		}
		button {
			outline: none;
			border: none;
			background: transparent;
			cursor: pointer;
		}
		/*---------------------------------------------*/
		.wrap-slick3-arrows {
			position: absolute;
			z-index: 100;
			right: 0;
			top: calc(50% - 20px);
		}

		.arrow-slick3 {
			font-size: 25px;
			color: #fff;
			
			position: absolute;
			top: 0;
			width: 40px;
			height: 40px;
			background-color: rgba(0,0,0,0.5);

			-webkit-transition: all 0.4s;
			-o-transition: all 0.4s;
			-moz-transition: all 0.4s;
			transition: all 0.4s;
		}

		.arrow-slick3:hover {
			background-color: rgba(0,0,0,0.9);
		}

		.prev-slick3 {left: 0px;}
		.next-slick3 {right: 0px;}
		.prev-slick3:focus {
			border: none;
			outline: none;
			box-shadow: none;
		}
		.next-slick3:focus {
			border: none;
			outline: none;
			box-shadow: none;
		}
		/*---------------------------------------------*/

		/* Bottom Images */
		.wrap-slick3-dots {
			width: 100%;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		ul.slick3-dots {
			display: flex;
			flex-flow: row nowrap;
			column-gap: 10px;    
			border-radius: 0 0 25px 25px;
			overflow: hidden;
			padding-left: 0;
			margin-bottom: 0;
		}
		.slick3-dots li {
			display: block;
			position: relative;
			width: 100%;
			max-width: 100px;
			height: 100px;
			margin-bottom: 0;
		}
		.slick3-dots li img {
			width: 100%;
    		height: 100%;
			object-fit: cover;
		}
		.slick3-dot-overlay {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			cursor: pointer;
			border: 2px solid transparent;
			-webkit-transition: all 0.4s;
			-o-transition: all 0.4s;
			-moz-transition: all 0.4s;
			transition: all 0.4s;
		}
		.slick3-dot-overlay:hover {
			border-color: #ccc;
		}
		.slick3-dots .slick-active .slick3-dot-overlay {
			border-color: transparent;
		}
	</style>

	<style>
		.arrow-wrapper {
			background-color: rgba(0,0,0,.6);
			width: 40px;
			height: 40px;
			display: flex;
			align-items: center;
			justify-content: center;
			z-index: 1;
			top: calc(50% - 20px);
			cursor: pointer;
			/* position: relative;
			top: 0; */
			display: none !important;
		}
		.arrow-wrapper:hover {
			background-color: rgba(0,0,0,.7);
		}
		.arrow-img {
			width: 15px;
			height: 15px;
			opacity: 1;
			background-color: transparent;
		}
		.arrow-img:hover {
			width: 15px;
			height: 15px;
			background-color: transparent;
		}
	</style>





    <div class="container">
						
        <?php
            $product = new MyApp\Classes\Product();

            $product_id = $_GET['pid'];
            $product->product($product_id);
        ?>
        

    </div>



</div>


    

<script src="lib/select2/select2.min.js?v=5"></script>
<script src="lib/slick/slick.min.js?v=5"></script>
<script src="js/slick-custom.js?v=5"></script>

<script defer>

	$(document).ready(function() {
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		});
	});



	$('.btn-num-product-down').on('click', function(){
		var numProduct = Number($(this).next().val());
		if(numProduct > 0) $(this).next().val(numProduct - 1);
	});

	$('.btn-num-product-up').on('click', function(){
		var numProduct = Number($(this).prev().val());
		$(this).prev().val(numProduct + 1);
	});


	// $('.qty-down').on('click', function(){
	// 	var numProduct = Number($(this).next().text());
	// 	if(numProduct > 0) $(this).next().text(numProduct - 1);
	// });

	// $('.qty-up').on('click', function(){
	// 	var numProduct = Number($(this).prev().text());
	// 	$(this).prev().text(numProduct + 1);
	// });

</script>

<!-- Sizes -->
<script defer>
	function select_size(className) {
		$('.size-option').removeClass('selected');
		
		if(!$('.'+className).hasClass('selected')) {
			$('.'+className).addClass('selected');
		} else {
			$('.'+className).removeClass('selected');
		}
	}
</script>

<?php
    // include './partials/footer-basic.php';
?>
<?php
    include './partials/footer.php';
?>