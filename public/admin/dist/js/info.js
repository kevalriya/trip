const updateInformation = (url, token) => {
  $("#tabInfo").dblclick(function () {
    $(this).css("border", "1px solid #222222")
    $(this).removeAttr("readonly")
    $(this).css("width", "95%")
    $("#infoUpdate").css("display", "block")
  })

  $("#infoUpdate").click(function () {
    let id = parseInt($("#tabInfo").attr("data-id"))
    let data = $("#tabInfo").val()

    $("#tabInfo").attr("readonly", "true")
    $("#tabInfo").css("border", "none")
    $("#tabInfo").css("width", "100%")
    $(this).hide()
    $.ajax({
      url: url,
      type: "PUT",
      data: { data: data, id: id, _token: token },
      success: function (response) {
        //
      },
    })
  })
}
