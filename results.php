<!DOCTYPE html>
<html>
<head>
<style>

.div1 {float:left; width:30%;border-top:1px #eeeeee solid;border-left:1px #eeeeee solid;height:2em;}
.div2 {float:left;width:10%;border-top:1px #eeeeee solid;border-right:1px #eeeeee solid;height:2em;border-left:1px #eeeeee solid;height:2em;}
.clearit {clear:left;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
    $("button").click(function(){
    var url="http://www.lilaoc.com/progtest/test.php?address="+ $("#address").val();    
    $.getJSON(url,null,function(result) 
        {
          console.log(result);
          if (result.status=="OK")
            {
            $(".div4").append('<div class="div1">' +result.formatted_address + '</div><div class="div2">' +result.zipcode+'</div><br class="clearit">');
          
            }

         
        }//end json function

      ); //end getjson
    });
} //end bracket of ready function
); //end ready function
</script>
</head>
<body>


<div class="div3">
<input type="text" value="" name="address" id="address"><br>
<button>Convert Address</button>
</div>

<div class="div4">
  <div class="div1">Address</div><div class="div2">Zipcode</div><br class="clearit">
<?php 
include "dbaccess.php";
$sql="select * from addresses";
$address_data=$myconnection->query($sql);

while ($row = $address_data->fetch_assoc())

{
echo '<div class="div1">'.$row["valid_address"].'</div><div class="div2">'. $row["zipcode"].'</div><br class="clearit">';
}

 ?>

</div>


</body>
</html>
