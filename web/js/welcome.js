$(document).ready(function () {

    $('#ac-classes-table tbody tr td:first-child').click(function () {

        var name = $(this).html();
        var op = "cn";

        if (name === "L")
        {
            name = "L1,L2";
            op = "in";
        }
        else if (name === "U")
        {
            name = "U,Ua,Ub,Uc";
            op = "in";
        }

        localStorage.classFilter = '{"field":"additional_class_type","op":"' + op + '","data":"' + name + '"}';
        localStorage.applyFilter = true;

        window.location = "table/overview";
    });

    $('#ac-classes-table div').click(function () {

        var name = $(this).parent().siblings("td").html();

        if (name === "L")
        {
            var divName = $(this).html();
            if (divName.indexOf("L1") > -1)
                name = "L1";
            else
                name = "L2";
        }
        else if (name === "U")
        {
            var divName = $(this).html();
            if (divName.indexOf("Ua") > -1)
                name = "Ua";
            else if (divName.indexOf("Ub") > -1)
                name = "Ub";
            else if (divName.indexOf("Uc") > -1)
                name = "Uc";
            else
                name = "U";
        }

        localStorage.classFilter = '{"field":"additional_class_type","op":"cn","data":"' + name + '"}';
        localStorage.applyFilter = true;

        window.location = "table/overview";
    });

    $('#SWSM').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"1,4,7"}';
        localStorage.applyFilter = true;
    });

    $('#SWOSM').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"2,5,8a,8b"}';
        localStorage.applyFilter = true;
    });

    $('#NS').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"3,6,9"}';
        localStorage.applyFilter = true;
    });

    $('#CS').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"1,2,3"}';
        localStorage.applyFilter = true;
    });

    $('#CM').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"4,5,6"}';
        localStorage.applyFilter = true;
    });

    $('#NC').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"7,8a,8b,9"}';
        localStorage.applyFilter = true;
    });

    $('#Class1').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"1"}';
        localStorage.applyFilter = true;
    });

    $('#Class2').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"in","data":"2"}';
        localStorage.applyFilter = true;
    });

    $('#Class3').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"3"}';
        localStorage.applyFilter = true;
    });

    $('#Class4').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"4"}';
        localStorage.applyFilter = true;
    });

    $('#Class5').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"5"}';
        localStorage.applyFilter = true;
    });

    $('#Class6').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"6"}';
        localStorage.applyFilter = true;
    });

    $('#Class7').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"7"}';
        localStorage.applyFilter = true;
    });

    $('#Class8a').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"8a"}';
        localStorage.applyFilter = true;
    });

    $('#Class8b').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"8b"}';
        localStorage.applyFilter = true;
    });

    $('#Class9').click(function ()
    {
        localStorage.classFilter = '{"field":"main_class_type","op":"cn","data":"9"}';
        localStorage.applyFilter = true;
    });

    $('#sfari').click(function ()
    {
        localStorage.classFilter = '{"field":"gene_group","op":"cn","data":"Autism candidate genes"}';
        localStorage.applyFilter = true;
    });

    $('#ac-classes-table div').hover(
            function () {
                $(this).parent().siblings("td").css("background-color", "#bcbcbc");
            },
            function () {
                $(this).parent().siblings("td").css("background-color", "#E9E9E9");
            }
    );

    $('#ac-classes-table tbody td:first-child').hover(
            function () {
                $(this).parent().children("td").css("background-color", "#bcbcbc");
            },
            function () {
                $(this).css("background-color", "#E9E9E9");
                $(this).siblings("td").css("background-color", "transparent");
            }
    );
    
    $('#update-info a:first-child').click(function () {
        localStorage.classFilter = '{"field":"gene_group","op":"eq","data":"Current primary ID genes"}';
        localStorage.applyFilter = true;
    });

    $('#update-info a:nth-child(2)').click(function () {
        localStorage.classFilter = '{"field":"gene_group","op":"eq","data":"ID candidate genes"}';
        localStorage.applyFilter = true;
    });
});