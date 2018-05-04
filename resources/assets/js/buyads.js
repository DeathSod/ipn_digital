$(document).ready(function()
{
    let checkedSizes = [];

    $('.check-sizes').click(function()
    {
        let btnClass = $(this).attr("class");
        let m = btnClass.includes('check-sizes');
        let n = btnClass.includes('btn-danger');
        if(m && n)
        {
            $(this).removeClass('btn-danger');
            $(this).addClass('btn-success');
            checkedSizes.push($(this).val());
        }
        else{
            for(let i = checkedSizes.length - 1; i >= 0; i--)
            {
                if(checkedSizes[i] === $(this).val())
                {
                    checkedSizes.splice(i, 1);
                    $(this).removeClass('btn-success');
                    $(this).addClass('btn-danger');
                    break;
                }
            }
        }
    });

    $('#checkAv').click(function(){
            
        let start = $("#inputCampaignDateStart").val();
        let end = $("#inputCampaignDateEnd").val();
        let cpm = $("#inputCpm").val();
        let impLvl = $("#inputImportanceLevel").val();

        if(checkedSizes.length == 0 || cpm.length == 0 || start.length == 0 || end.length == 0)
        {
            $("#av-div").html("<h1 class='text-center'>The availability of your ads will appear here.</h1>");
            return;
        }
        else {
            $("#av-div").html("<div class='loader'></div>");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/home/forecast",
                data: {sizes : checkedSizes, start: start, end : end, cpm : cpm, impLvl : impLvl},
                success: function (response) {
                    $("#av-div").html(response);
                },
                error: function()
                {
                    $("#av-div").html('<h1 class="text-center">Something went wrong with the request, Try again later.</h1>');
                }
            });
        
        }
    });

    $('#continueAv').click(function(){
        
    });
});