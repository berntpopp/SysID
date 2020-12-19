function exportToCsv(postData, url) {

    var f = document.createElement('form');
    f.action = url;
    f.method = 'get';

    var exportt = document.createElement('input');
    exportt.name = 'exportt';
    exportt.value = true;

    var search = document.createElement('input');
    search.name = '_search';
    search.value = postData._search;

    var sidx = document.createElement('input');
    sidx.name = 'sidx';
    sidx.value = postData.sidx;

    var sord = document.createElement('input');
    sord.name = 'sord';
    sord.value = postData.sord;

    var filters = document.createElement('input');
    filters.name = 'filters';
    filters.value = postData.filters;

    f.appendChild(exportt);
    f.appendChild(search);
    f.appendChild(sidx);
    f.appendChild(sord);
    f.appendChild(filters);

    document.body.appendChild(f);
    f.submit();
    document.body.removeChild(f);
}
;

function returnFlyHyperLink(cellValue, options, rowdata, action) {    
    var result = "";
    if (cellValue !== null)
        result = "<a href='../fly-gene/" + rowdata['fly_gene_id'] + "'>" + cellValue + "</a>";
    return result;
}

function returnHumanHyperLink(cellValue, options, rowdata, action) {
    var result = "";
    if (cellValue !== null)
        result = "<a href='../human-gene/" + rowdata['human_gene_id'] + "'>" + cellValue + "</a>";
    return result;
}

function returnEntrezHyperLink(cellValue, options, rowdata, action) {
    var result = "";
    if (cellValue !== null)
        result = "<a href='http://www.ncbi.nlm.nih.gov/gene/" + cellValue + "' target='_blank'>" + cellValue + "</a>";
    return result;
}

function returnEnsemblHyperLink(cellValue, options, rowdata, action) {
    var result = "";
    if (cellValue !== null)
        result = "<a href='http://www.ensembl.org/Homo_sapiens/Gene/Summary?db=core;g=" + cellValue + "' target='_blank'>" + cellValue + "</a>";
    return result;
}

function returnOmimHyperLink(cellValue, options, rowdata, action) {
    var result = "";
    if (cellValue !== null)
        result = "<a href='http://omim.org/entry/" + cellValue + "' target='_blank'>" + cellValue + "</a>";
    return result;
}

function returnHPRDHyperLink(cellValue, options, rowdata, action) {
    var result = "";
    if (cellValue !== null)
        result = "<a href='http://www.hprd.org/summary?hprd_id=" + cellValue + "&isoform_id=" + cellValue + "_1&isoform_name=Isoform_1' target='_blank'>" + cellValue + "</a>";
    return result;
}

function returnHGNCHyperLink(cellValue, options, rowdata, action) {
    var result = "";
    if (cellValue !== null)
        result = "<a href='https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/HGNC:" + cellValue + "' target='_blank'>" + cellValue + "</a>";
    return result;
}

function boldIDgenes(cellValue, options, rowdata, action) {
    var tf = rowdata['transcription_factor'];
    var idTf = rowdata['id_transcription_factor'];

    if (idTf !== null)
    {
        var idTfDelimited = idTf.split(",");

        for (i = 0; i < idTfDelimited.length; i++)
        {
            tf = tf.replace(idTfDelimited[i], "<b>" + idTfDelimited[i] + "</b>");
        }
    }  
    
    return tf;
}

function returnSpanedMotifs(cellValue, options, rowdata, action)
{
    var result = "";
    var motifsDelimited = cellValue.split("; ");    

        for (i = 0; i < motifsDelimited.length; i++)
        {
            result += "<div class='motif'>" + motifsDelimited[i] + "</div>";
        }
    
    
    if (rowdata['link'] !== '')
    {
        result = "<a href='http://test.swissregulon.unibas.ch/gbrowse2/fcgi/gbrowse/hg19/?name=id:" + rowdata['link'] + ";dbid=hg19:database' target='_blank'>" + result + "</a>";
    }
    
    return result;
}

function boldTf(cellValue, options, rowdata, action)
{
    var IdTfs = [];
    IdTfs['ADNP'] = true;
    IdTfs['ARX'] = true;
    IdTfs['ASCL1'] = true;
    IdTfs['CTCF'] = true;
    IdTfs['DEAF1'] = true;
    IdTfs['EMX2'] = true;
    IdTfs['FOXG1'] = true;
    IdTfs['FOXP1'] = true;
    IdTfs['GLI2'] = true;
    IdTfs['GLI3'] = true;
    IdTfs['GON4L'] = true;
    IdTfs['HESX1'] = true;
    IdTfs['HOXA1'] = true;
    IdTfs['MEF2C'] = true;
    IdTfs['MYCN'] = true;
    IdTfs['NKX2-1'] = true;
    IdTfs['NR2F1'] = true;
    IdTfs['PAX6'] = true;
    IdTfs['RARB'] = true;
    IdTfs['SALL1'] = true;
    IdTfs['SATB2'] = true;
    IdTfs['SIX3'] = true;
    IdTfs['SKI'] = true;
    IdTfs['SMAD4'] = true;
    IdTfs['SOX10'] = true;
    IdTfs['SOX2'] = true;
    IdTfs['SOX3'] = true;
    IdTfs['SOX5'] = true;
    IdTfs['TBR1'] = true;
    IdTfs['TCF12'] = true;
    IdTfs['TCF4'] = true;
    IdTfs['TGIF1'] = true;
    IdTfs['THRB'] = true;
    IdTfs['ZBTB40'] = true;
    IdTfs['ZEB2'] = true;
    IdTfs['ZIC2'] = true;
    IdTfs['ZNF41'] = true;
    IdTfs['ZNF526'] = true;
    IdTfs['ZNF592'] = true;
    IdTfs['ZNF711'] = true;
    IdTfs['ZNF81'] = true;


    if (IdTfs[cellValue] === true)
    {
        return  "<a href='../human-gene/" + rowdata['human_gene_id'] + "'><b>" + cellValue + "</b></a>";
    }
    else
    {
        return  "<a href='../human-gene/" + rowdata['human_gene_id'] + "'>" + cellValue + "</a>";
    }
}

function GridCompleteCustomize(identifier)
{
    if ($(".ui-pg-selbox option:selected").text() === "All")
        jQuery("#t-" + identifier).jqGrid('setGridHeight', $(window).height() - $('.navbar').height() - $('.ui-jqgrid-hdiv').height() - 130);
    else
        jQuery("#t-" + identifier).jqGrid('setGridHeight', '100%');

    var userdata = jQuery("#t-" + identifier).jqGrid('getGridParam', 'userData');
    var userdataString = "";
    for (var k in userdata) {
        userdataString += "<span style='margin:4px 10px 0px 5px; display:inline-block'>" + k + ": " + userdata[k] + "</span>";
    }
    $("#t_t-" + identifier).html(userdataString);
    $(".soptclass").removeAttr("title");
}

function LoadCompleteCustomize(identifier)
{
    $("option[value=1000000]").text('All');
    if ($("#t-" + identifier).jqGrid('getGridParam', 'reccount') === 0)
        $(".jqgfirstrow").css("height", "1px");
}

function TableSetSchrinkToFit(containerWidth, width, identifier)
{
    var shrinkToFit = $("#t-" + identifier).jqGrid('getGridParam',"shrinkToFit");

    if (containerWidth < width && shrinkToFit == true) {
        $("#t-" + identifier).jqGrid('setGridParam', {shrinkToFit: false});//.trigger('reloadGrid');
    }
    else if (containerWidth >= width && shrinkToFit == false) {
        $("#t-" + identifier).jqGrid('setGridParam', {shrinkToFit: true});//.trigger('reloadGrid');
    }
}

function WindowResize(width, identifier)
{
    var containerWidth = $('.container-fluid').width();
    TableSetSchrinkToFit(containerWidth, width, identifier);
    $("#t-" + identifier).setGridWidth(containerWidth);
}

function AddDownloadButton(identifier)
{
    jQuery("#t-" + identifier).jqGrid('navGrid', "#pager-t-" + identifier).jqGrid('navButtonAdd', "#pager-t-" + identifier, {
        caption: "",
        buttonicon: "ui-icon-arrowthickstop-1-s",
        onClickButton: function () {
            exportToCsv(jQuery("#t-" + identifier).jqGrid('getGridParam', 'postData'), jQuery("#t-" + identifier).jqGrid('getGridParam', 'url'));
        },
        position: 'first',
        title: "Export to csv",
        cursor: "pointer"
    });
}

function CustomizeTable(table, width, edit)
{
    if (typeof edit === "undefined")
    {
        edit = false;
    }

    $("#t-" + table).jqGrid('filterToolbar', {searchOnEnter: false, ignoreCase: false, searchOperators: true, stringResult: true});

    jQuery("#t-" + table).navGrid("#pager-t-" + table, {edit: edit, add: edit, del: false, search: true, refresh: true}, {}, {}, {}, {multipleSearch: true, multipleGroup: false, showQuery: false});

    $('.ui-jqgrid-titlebar-close').remove();

    TableSetSchrinkToFit($('.container-fluid').width(), width, table);

    $(window).bind('resize', function () {
        WindowResize(width, table);
    }).trigger('resize');

    AddDownloadButton(table);
}

function setTooltipsOnColumnHeader(grid, column, text) {
    jQuery(grid + '_' + column).attr("title", text);
}
;