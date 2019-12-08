$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    $('#inputHidenRating').val(this.getAttribute('data-value'))
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    // responseMessage(msg);
    
  });
  // $('#stars').on('click',function(){
  //   alert($('#stars li.selected').val())
  // })
  
  $('#btnDate1').on('click',function(){
    
    $('#test').val($('#btnDate1').val())
    $('#test2').val($('#inputTest').val())
    b = $('#room').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
  $('#btnDate2').on('click',function(){
    
    $('#test').val($('#btnDate2').val())
    b = $('#room1').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder1').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
  $('#btnDate3').on('click',function(){
    
    $('#test').val($('#btnDate3').val())
    b = $('#room2').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder2').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
  $('#btnDate4').on('click',function(){
    
    $('#test').val($('#btnDate4').val())
    b = $('#room3').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder3').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
  $('#btnDate5').on('click',function(){
    
    $('#test').val($('#btnDate5').val())
    b = $('#room4').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder4').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
  $('#btnDate6').on('click',function(){
    
    $('#test').val($('#btnDate6').val())
    b = $('#room5').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder5').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
  $('#btnDate7').on('click',function(){
    
    $('#test').val($('#btnDate7').val())
    b = $('#room6').val()
    bb = b.split(",")

    aaa = ''
    for(var i = 0; i<bb.length-1; i++)
    {
      tem = bb[i].split(':')
      aaa += ("<input  type='radio' name='detail_id' value = "+tem[0]+"> "+tem[1]+'<span style="width: 110px; margin-left:90px;">' +tem[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem[3]+ '</span> '+"<br>")
    }
    $('#arrdetail').html(aaa)

    b1 = $('#roomorder6').val()
    bb1 = b1.split(",")

    aaa1 = ''
    for(var i = 0; i<bb1.length-1; i++)
    {
      tem1 = bb1[i].split(':')
      aaa1 += ("<input   disabled type='radio' name='detail_id' value = "+tem1[0]+"> "+tem1[1]+'<span style="width: 110px; margin-left:90px;">' +tem1[2]+ '</span> '+'<span style="width: 110px; margin-left:90px;">' +tem1[3]+ '</span> '+"<br>")
    }
    $('#arrdetail1').html(aaa1)
  })
});

function FindRoom(a){
  alert($(this).val())
  $.ajax({
    url : '',
    type: 'POST',
    data: {

    },
    success: function(data){

    },
    error: function(data){

    }

  })
}
