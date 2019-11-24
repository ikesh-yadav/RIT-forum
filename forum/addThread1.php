<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
div.a {
	
	height:px;
  border-top: 5px solid red;
border-width: 100px 1px;
outline:  solid 0px;	
}
div.b{

	height:576px;
border-left: 5px solid red;
border-width: 1px 100px;
outline:  solid 0px;
}


.q {
  font-family: Futura, 'Trebuchet MS', Arial, sans-serif;
  font-size: 16px;
  font-style: italic;
  font-variant: normal;
  font-weight: bold;
  margin: 0 auto;
  display: block;
  width: 800px;
size:70;
padding:20px;
}

</style>
</head>
<body>
<div class="a"></div>
<div class="b">


<form method="post">

	</br></br></br></br></br>
      <input type="text" class="q" placeholder="Enter Title" name="title" required >
	</br></br>
<input type="text" class="q" placeholder="Enter Subject" name="sub" required>
</br></br>

	 <p class="q">Select Category:</p>
      <input type = "text" class="q" list = "cats" name="cats">
      <datalist id = "cats">
        <option value = "a">
        <option value = "b">
        <option value = "c">
        <option value = "d">
      </datalist>
      </br><br>
      <button type="submit" class="q" onclick="">Create</button>



</div>  
</body>
</html>
