<style>	
/* SLIDE THREE */
.slideThree {
	width: 80px;
	height: 26px;
	background: #333;
	margin: 20px auto;

	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	border-radius: 50px;
	position: relative;

	-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
	-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
	box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.slideThree:after {
	content: 'Tắt';
	font: 12px/26px Arial, sans-serif;
	color: #000;
	position: absolute;
	right: 10px;
	top: 0px;
	z-index: 0;
	font-weight: bold;
	text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.slideThree:before {
	content: 'Bật';
	font: 12px/26px Arial, sans-serif;
	color: #00bf00;
	position: absolute;
	left: 10px;
	z-index: 0;
	font-weight: bold;
}

.slideThree label {
	display: block;
	width: 34px;
	height: 20px;

	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	border-radius: 50px;

	-webkit-transition: all .4s ease;
	-moz-transition: all .4s ease;
	-o-transition: all .4s ease;
	-ms-transition: all .4s ease;
	transition: all .4s ease;
	cursor: pointer;
	position: absolute;
	top: 3px;
	left: 3px;
	z-index: 1;

	-webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	-moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	background: #fcfff4;

	background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.slideThree input[type=checkbox]:checked + label {
	left: 43px;
}
input[type=checkbox] {
    visibility: hidden;
}
</style>
<div class="slideThree">	
	<input type="checkbox" value="None" id="slideThree" name="check" />
	<label for="slideThree"></label>
</div>
<!-- Rounded ONE -->

<style>	
.roundedOne {
	width: 28px;
	height: 28px;
	background: #fcfff4;

	background: -webkit-linear-gradient(bottom, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	margin: 0 auto;

	-webkit-border-radius: 50px;
	

	-webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
	box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
	position: relative;
}

 .roundedOne label {
	cursor: pointer;
	position: absolute;
	width: 20px;
	height: 20px;

	-webkit-border-radius: 50px;
	left: 4px;
	top: 4px;

	background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
	
}

.roundedOne label:after {
	opacity: 0;
	content: '';
	position: absolute;
	width: 16px;
	height: 16px;
	background: #00bf00;

	background: -webkit-linear-gradient(top, #00bf00 0%, #009400 100%);

	-webkit-border-radius: 50px;
	
	top: 2px;
	left: 2px;

}

.roundedOne label:hover::after {
	opacity: 0.3;
}

.roundedOne input[type=checkbox]:checked + label:after {
	opacity: 1;
} 
</style>
<div class="roundedOne">
	<input type="checkbox" value="None" id="roundedOne" name="check" />
	<label for="roundedOne"></label>
</div>
