var compare_dates = function(date1,date2){
    if (date1<=date2) return (false);
  else return (true);
  }
  
function checkIN(val) {
    dateout = document.getElementById('checkout');
    if (dateout.value != ""){
      inn = new Date(val.value);
      out = new Date(dateout.value);
      if (compare_dates(inn, out)){
        alert('Sorry, CHECK-IN date cannot exceed CHECK-OUT date!')
        val.value=0;
      }
    }     
  }
function checkOUT(val) {
    datein = document.getElementById('checkin');
    if (datein.value != ""){
      inn = new Date(datein.value);
      out = new Date(val.value);
      if (compare_dates(inn, out)){
        alert('Sorry, CHECK-IN date cannot exceed CHECK-OUT date!')
        val.value=0;
      }
    }  
  }