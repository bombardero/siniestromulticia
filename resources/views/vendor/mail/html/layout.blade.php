<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {

.button {
width: 100% !important;
}

  
}
.body {
	font-family: 'Lato', sans-serif;
}
.footer {
	background-color: #4F4F4F;
	width: 75%;

}
.container-mail {
  display: inline-block;
}
.container-email-mobile {
	display:none;
}

.section-mail {
  flex: 1 !important; /*grow*/
}
.enlace-mail {
	font-family: Roboto;
	font-style: normal;
	font-weight: 500;
	font-size: 13px;
	line-height: 25px;
	letter-spacing: 0.02em;
	color: #FFFFFF !important;

}
.siniestro-footer-mail {
	padding-top:10px; 
	text-align: left;
	font-family: Roboto;
	font-style: normal;
	font-weight: 500;
	font-size: 10px;
	text-align: left;
	line-height: 25px;
	letter-spacing: 0.02em;
	color: #FFFFFF !important;
}
.interno-mail {
	text-align: left;
	font-family: Roboto;
	font-style: normal;
	font-weight: 900;
	font-size: 20px !important;
	line-height: 25px;
	letter-spacing: 0.02em;
	color: #FFFFFF !important;
}
  .imagen-mail {
  	padding-top:10px; 
  	text-align:left; 
  	max-width:100%;height:auto;
  }

@media (max-width: 768px) { 

  .container-mail {
    display:none !important;
  }
  .container-email-mobile {
  	display:inline-block !important;
  }

  .siniestro-footer-mail {
  	text-align: center !important;
  }
  .enlace-mail {
  	text-align: center !important;
  }
   .interno-mail {
  	text-align: center !important;
  }

  .imagen-mail {
  	text-align:center !important; 
  }
  .footer {
  	width: 100% !important;
  }
}

</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0">
<table class="inner-body" align="center" width="75%" style="width: 75% !important;" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell">
{{ Illuminate\Mail\Markdown::parse($slot) }}

{{ $subcopy ?? '' }}
</td>
</tr>
</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
</body>
</html>
