$(document).ready(function () {

    var table = $("#example1").DataTable({
        "columnDefs": [
            {
                "targets": [0],
                "visible": false
            }
        ],
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
    $('#sProfesseur').attr({value: '', disabled: 'disabled'});
    $('#aProfesseur').attr({value: '', disabled: 'disabled'});
    //$('#mProfesseur').attr({value: '', disabled: 'disabled'});
    $('#vProfesseur').attr({value: '', disabled: 'disabled'});

    $('#example1 tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            ('#sProfesseur').attr({value: '', disabled: 'disabled'});
            $('#aProfesseur').attr({value: '', disabled: 'disabled'});
           // $('#mProfesseur').attr({value: '', disabled: 'disabled'});
            $('#vProfesseur').attr({value: '', disabled: 'disabled'});
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            // Get the data array for this row
            var aData = table.row(this.rowIndex - 1).data();
           // console.log("aData: ", aData[0]);
            $('button').removeAttr('disabled');

            $('#sProfesseur').attr({value: aData[0]});
            $('#aProfesseur').attr({value: aData[0]});
           // $('#mProfesseur').attr({value: aData[0]});
            $('#vProfesseur').attr({value: aData[0]});
            

        }
    });
    
    /***supression***/
        $('#sProfesseur').click(function(){
            var code= $(this).attr('value');
            $.ajax({
                url: '/schoollink/web/app_dev.php/dashboard/service/professeur/delete',
                type : 'POST',
                dataType : "html",
                data : { id : code}
            });           

        });
});