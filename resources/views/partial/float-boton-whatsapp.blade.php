<style>


.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:60px;
	right:50px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  	font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}
.float:hover {
	text-decoration: none;
	color: #25d366;
  background-color:#fff;
}

.my-float{
	margin-top:16px;
}



</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone={{env('WHATSAPP_NUMBER')}}&text=&source=&data=&app_absent=" id="clickwhatsapp2" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
