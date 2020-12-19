$("#t-overview").jqGrid({
    url: 'get-data/overview',
    datatype: "json",
    height: '100%',
    autowidth: false,
    mtype: "GET",
    colNames: ['Id', 'Human gene id', 'Symbol', 'Entrez id', 'SysID', 'Chromosome location', 'Gene type', 'Gene group', 'Gene description', 'Gene ontology-based annotation', 'Fly gene id', 'Flybase id', 'Gene name', 'Orthology determination', 'Wing phenotype overview', 'Neuronal phenotype overview', 'Human gene disease id', 'Inheritance pattern', 'Inheritance type', 'Main class', 'Accompanying phenotype', 'Limited confidence criterion', 'Sysid yes no', 'Disease subtype', 'Disease type', 'Additional references', 'Omim disease', 'Haploinsufficiency', 'hPSD', 'Clinical synopsis'],
    colModel: [
        {name: "id", title: false, hidden: true},
        {name: "human_gene_id", title: false, hidden: true},
        {name: "gene_symbol", title: false, width: "110", formatter: returnHumanHyperLink, sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
        {name: "entrez_id", title: false, width: "100", align: "center", formatter: returnEntrezHyperLink, sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
        {name: "sysid_id", title: false, width: "130", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "chromosome_location", title: false, width: "100", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "gene_type", title: false, width: "120", stype: 'select', searchoptions: {sopt: ['eq'], value: ":All;ncRNA:ncRNA;protein-coding:protein-coding;tRNA:tRNA"}},
        {name: "gene_group", title: false, width: "200", stype: 'select', searchoptions: {sopt: ['eq'], value: ":All;ID data freeze 388:ID data freeze 388;ID data freeze 650:ID data freeze 650;Current primary ID genes:Current primary ID genes;ID candidate genes:ID candidate genes"}},
        {name: "gene_description", title: false, width: "400", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "super_go", title: false, width: "300", stype: 'select', searchoptions: {sopt: ['cn'], value: ":All;actin:actin;BMP signaling:BMP signaling;cardiac muscle contraction:cardiac muscle contraction;cell cycle:cell cycle;centrosome:centrosome;chromatin:chromatin;chromosome segregation:chromosome segregation;Cilia:Cilia;DNA repair:DNA repair;dopamin receptor signaling:dopamin receptor signaling;glutamate receptor signaling:glutamate receptor signaling;glycosylation:glycosylation;hedgehog signaling:hedgehog signaling;ion transport:ion transport;MAPK signaling:MAPK signaling;metabolism:metabolism;microtubule:microtubule;mitochondria:mitochondria;MT transport:MT transport;nervous system development:nervous system development;peroxisome:peroxisome;protein transport:protein transport;response to growth factor:response to growth factor;RNA metabolism:RNA metabolism;small GTPase signaling:small GTPase signaling;synapse:synapse;TOR signaling:TOR signaling;transcription:transcription;transporters:transporters;ubiquitination:ubiquitination;vesicle transport:vesicle transport;Wnt signaling:Wnt signaling"}},
        {name: "fly_gene_id", title: false, hidden: true},
        {name: "flybase_id", title: false, width: "100", sorttype: 'string', formatter: returnFlyHyperLink, searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "gene_name", title: false, width: "200", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "orthology_determination", title: false, width: "200", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "wing_phenotype_overview", title: false, width: "160", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "neuronal_phenotype_overview", title: false, width: "160", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "human_gene_disease_id", title: false, hidden: true},
        {name: "inheritance_pattern", title: false, width: "160", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "inheritance_type", title: false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "main_class_type", title: false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'in', 'ni']}},
        {name: "additional_class_type", title: false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'in', 'ni']}},
        {name: "confidence_criteria_limit_no_patient", title: false, width: "120", formatter: "checkbox", align: "center", stype: 'select', searchoptions: {value: ":All;1:Yes;0:No"}},
        {name: "sysid_yes_no", title: false, width: "120", formatter: "checkbox", align: "center", stype: 'select', searchoptions: {value: ":All;1:Yes;0:No"}},
        {name: "disease_subtype", title: false, width: "350", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "disease_type", title: false, width: "240", sorttype: 'string', searchoptions: {sopt: ['eq', 'bw', 'bn', 'cn', 'nc', 'ew', 'en']}, hidden: true},
        {name: "additional_references", title: false, width: "150", hidden: true},
        {name: "omim_disease", title: false, align: "center", width: "120", sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge']}},
        {name: "haploinsufficiency_yes_no", title: false, width: "130", formatter: "checkbox", align: "center", stype: 'select', searchoptions: {value: ":All;1:Yes;0:No"}},
        {name: "hpsd", title: false, width: "120", align: "center", formatter: "checkbox", stype: 'select', searchoptions: {value: ":All;1:Yes;0:No"}},
        {name: "clinical_synopsis", title: false, width: "500", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}}
    ],
    shrinkToFit: true,
    rowNum: 30,
    rowList: [10, 20, 30, 40, 50, 1000000],
    loadComplete: function () {LoadCompleteCustomize("overview");},
    pager: "#pager-t-overview",
    sortname: "human_gene_id",
    viewrecords: true,
    sortorder: "asc",
    gridview: true,
    autoencode: true,
    caption: "Overview",
    toolbar: [true, "bottom"],
    postData: {filters: '{"groupOp":"AND","rules":[' + localStorage.classFilter + ']}'},
    search: typeof localStorage.applyFilter === "undefined" ? false : localStorage.applyFilter,
    gridComplete: function () {
        GridCompleteCustomize("overview");
        AddFilter();
    }
});

CustomizeTable("overview", 4425);

function AddFilter()
{
    if (typeof localStorage.applyFilter !== "undefined" && localStorage.applyFilter === "true")
    {        

        if (typeof localStorage.classFilter !== "undefined")
        {
            var parsed = JSON.parse(localStorage.classFilter);
            
            var operator = "~";
            
            if(parsed.op==="in")
            {
                operator = "=";
            }
            
            if (parsed.field === "main_class_type")
            {
                $("#gs_main_class_type").val(parsed.data);                
                $("#gs_main_class_type").parent().siblings(".ui-search-oper").children().text(operator);
                $("#gs_main_class_type").parent().siblings(".ui-search-oper").children().attr('soper', parsed.op);
            }
            else if (parsed.field === "additional_class_type")
            {
                $("#gs_additional_class_type").val(parsed.data);
                $("#gs_additional_class_type").parent().siblings(".ui-search-oper").children().text(operator);
                $("#gs_additional_class_type").parent().siblings(".ui-search-oper").children().attr('soper', parsed.op);
            }
            else if (parsed.field === "gene_group")
            {
                $("#gs_gene_group").val(parsed.data);
            }
        }
	
	localStorage.applyFilter = false;
    }
}