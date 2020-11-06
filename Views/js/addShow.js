const testAjax = (url) => {
    $.ajax({
        url: url,
        type: "POST",
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            //Error Handling
            if (response.responseJSON !== undefined) {
              $('#divErrores').hide();
              $('#divMessage').hide();
              showDangerMessage(response.responseJSON);
              topFunction();
              HideLoaderAbm();
              $('#Continua').val("");
            }
        }
      });
  }