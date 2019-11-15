<?php
    $categoryChoice1="himanshu is a boss";
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="common.css">
  <script>
      function add_option(name, value) {
        /*creating a label to append radiobutton and textfield*/
        var label = document.createElement("label");
        /*creating a radio button and textfield for new option*/
        var radio =document.createElement("input");
        radio.type = "radio";
        radio.name = name;
        radio.value = value;
        var opt=document.createElement("textarea");
        opt.style="width:70%";
        opt.className="options";
        /*opt.setAttribute("style","width:auto;");*/
        /*creating delete option button  */
        var deleteOption = document.createElement("input");
        deleteOption.onclick=function(){removeOption(this.parentElement)};
        deleteOption.type="button";
        deleteOption.value="x";
        deleteOption.innerHTML="x";
        deleteOption.className="toDisable";
        deleteOption.setAttribute("style","float:right;");
        /*creating a br element for displaying diffrent options in diffrent lines*/
        var br = document.createElement("br");
        /*appending radio ,input and delete button to label*/
        label.appendChild(radio);
        label.appendChild(opt);
        label.appendChild(deleteOption);
        label.insertBefore(br,radio);
        /*returning label element*/
        return label;
    }
  </script>
</head>
<body>
<div style ="background-color: rgb(0, 0, 51);font-size:0px;">
  <div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Exam</b></div>
  <br>
  <div style="display:block;width:100%;background-color: rgb(0, 0, 51);visibility: visible;" >
    <div id="topNavigation" class="tab" style="width:100%; display: inline-block;background-color:rgba(204, 0, 102, 0.63);color:white">
    <!--div in which the tabs for sections are added-->
    <input type="button" class="toDisable" id="tabLinkAdd" style="float:right" onclick="addTab()" value="Add Section"/>
    <div width style="display:inline-block;font-size:18px;float:right;" id="timeRemaining"></div>    
    </div>
  </div>
</div>
<form action ="createThread.php" method = "POST">
    <label for="threadName">Thread Name</label>
    <input type="text" id="threadName" name="threadName" placeholder="Enter thread name"/><br>
    <input type="textarea" id="threadDescription" name="threadDescription" placeholder="Enter Description"/>
    <div>
        <?php echo $categoryChoice1;?>
    </div>
    <input type="button" id="categoryDropDownAdd" style="display:inline" onclick="addCategoryDropDown()" value="add category"/>
    <input type="submit" class="toDisable" attr="subbtn" onclick="duplicatePageJS()" value="CREATE" />
</form>
<script type="text/javascript" src="editability.js"></script>
<form action='welcome.php' method='POST'><input type='submit' class='submitbtn' value='Go Back'/></form>"
<form action='logout.php' method='POST'><input type='submit' class="submitbtn" value='Log Out'/></form>
<script>
  var faculty=<?php echo $_SESSION['faculty'];?>;
  if (faculty){
    document.getElementById('timeRemaining').style.display="none";
  }
</script>
</body>
</html>