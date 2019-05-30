$(document).ready(function(){
  $("#tr_action_data").hide();
  $("#tr_food_data").hide();
  $("#transfer_data").hide();

  $("#deposit_btn").click(function(){
    $("#deposit_data").show();
    $("#tr_action_data").hide();
    $("#tr_food_data").hide();
    $("#transfer_data").hide();
  });

  $("#tr_action_btn").click(function(){
    $("#tr_action_data").show();
    $("#deposit_data").hide();
    $("#tr_food_data").hide();
    $("#transfer_data").hide();
  });

  $("#tr_food_btn").click(function(){
    $("#tr_food_data").show();
    $("#deposit_data").hide();
    $("#tr_action_data").hide();
    $("#transfer_data").hide();
  });

  $("#transfer_btn").click(function(){
    $("#transfer_data").show();
    $("#deposit_data").hide();
    $("#tr_action_data").hide();
    $("#tr_food_data").hide();
  })
});
