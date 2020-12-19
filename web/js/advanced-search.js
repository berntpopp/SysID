
$(document).ready(function () {
    
    $('#add-rule').click(function () {
        if (searcher.selectedCategory !== 'Choose category')
            searcher.addRule();
    });

    $('#advanced-search-form').submit(function () {
        searcher.submitSearch();
        $('#search-query').val(searcher.searchQuery);
        return true;
    });

    $("#selected-category").select2({
        minimumResultsForSearch: Infinity,
        placeholder: "Choose category"
    });

    $("#selected-category").on("change", function (e)
    {
        searcher.changeCategory(e.val);
    });

    var searcher = {
        searchValues: [],
        searchValuesLength: 0,
        columns: [],
        selectedCategory: "Choose category",
        searchQuery: "",
        sopt: {
            "equal": "eq",
            "does not equal": "ne",
            "begins with": "bw",
            "does not begin with": "bn",
            "ends with": "ew",
            "does not end with": "en",
            "contains": "cn",
            "does not contain": "nc",
            "is in": "in",
            "is not in": "ni",
            "=": "eq",
            "<>": "ne",
            "<": "lt",
            "<=": "le",
            ">": "gt",
            ">=": "ge"
        },
        rules: {
            "eq": "equal",
            "ne": "does not equal",
            "bw": "begins with",
            "bn": "does not begin with",
            "ew": "ends with",
            "en": "does not end with",
            "cn": "contains",
            "nc": "does not contain",
            "in": "is in",
            "ni": "is not in",
            "eqn": "=",
            "nen": "<>",
            "ltn": "<",
            "len": "<=",
            "gtn": ">",
            "gen": ">="
        },
        searchCategory: [
            "Human gene",
            "Fly gene"
        ],
        humanColumns: [
            {name: "Gene symbol", db: "gene_symbol", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene description", db: "gene_description", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Chromosome location", db: "chromosome_location", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene type", db: "gene_type", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene group", db: "gene_group", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene synonyms", db: "gene_synonyms", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Entrez id", db: "entrez_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Omim id", db: "omim_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Ensembl id", db: "ensembl_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Hprd id", db: "hprd_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Hgnc id", db: "hgnc_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go id", db: "go_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go std term", db: "go_std_term", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go evidence", db: "go_evidence", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go evidence remark", db: "go_evidence_remark", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Inheritance pattern", db: "inheritance_pattern", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Inheritance type", db: "inheritance_type", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Main class type", db: "main_class_type", searchoptions: ['cn', 'nc']},
            {name: "Accompanying phenotype", db: "additional_class_type", searchoptions: ['cn', 'nc']},
            {name: "Limited number of patients", db: "confidence_criteria_limit_no_patient", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Sysid yes no", db: "sysid_yes_no", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Disease subtype", db: "disease_subtype", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Disease type", db: "disease_type", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Alternative names", db: "alternative_names", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Omim disease", db: "omim_disease", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Clinical synopsis", db: "clinical_synopsis", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']}
        ],
        flyColumns: [
            {name: "Flybase id", db: "flybase_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene name", db: "gene_name", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene symbol", db: "gene_symbol", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Gene synonyms", db: "gene_synonyms", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "CG number", db: "cg_number", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go id", db: "go_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go std term", db: "go_std_term", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go evidence", db: "go_evidence", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Go evidence remark", db: "go_evidence_remark", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Stock id", db: "stock_id", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Stock type", db: "stock_type", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Order number", db: "order_number", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Order number svalue", db: "order_number_svalue", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']},
            {name: "Source", db: "source", searchoptions: ['eq', 'ne', 'bw', 'bn', 'ew', 'en', 'cn', 'nc']}
        ],
        addRule: function () {
            this.searchValues[this.searchValuesLength] = {name: this.columns[0].name, db: this.columns[0].db, op: this.rules[this.columns[0].searchoptions[0]], data: "", key: this.searchValuesLength};
            this.searchValuesLength += 1;
            this.renderButtons1();
        }
        ,
        deleteRule: function (key) {
            delete this.searchValues[key];
        },
        submitSearch: function () {
            this.saveData();
            var querySting = [];
            for (var item in this.searchValues) {
                querySting.push({field: this.searchValues[item].db, op: this.sopt[this.searchValues[item].op], data: this.searchValues[item].data});
            }

            var adSearch = {};
            adSearch.ct = this.selectedCategory;
            adSearch.qs = querySting;
            this.searchQuery = JSON.stringify(adSearch);
        }
        ,
        changeColumn: function (name, key) {
            var column = this.getColumn(name);
            this.searchValues[key].name = name;
            this.searchValues[key].db = column.db;
            this.searchValues[key].op = this.rules[column.searchoptions[0]];
        }
        ,
        changeStringRule: function (choice, key) {
            this.searchValues[key].op = choice;
        }
        ,
        changeCategory: function (choice) {
            if (this.selectedCategory !== choice) {
                this.selectedCategory = choice;
                this.searchValues = {};
                this.searchValuesLength = 0;
                if (choice === "Human gene") {
                    this.columns = this.humanColumns;
                }
                else if (choice === "Fly gene") {
                    this.columns = this.flyColumns;
                }
                this.addRule();
            }
        }
        ,
        saveData: function () {
            var data = {data: this.searchValues, selected: this.selectedCategory};
            sessionStorage.advancedSearch = JSON.stringify(data);
        }
        ,
        loadData: function () {
            var data = sessionStorage.advancedSearch;
            if (typeof (data) === 'undefined') {
                return data;
            }
            else
            {
                return JSON.parse(data);
            }
        }
        ,
        getColumn: function (name) {
            for (var i = 0; i < this.columns.length; i++) {
                if (this.columns[i].name === name) {
                    return this.columns[i];
                }
            }
        }
        ,
        renderButtons: function ()
        {
            var html = '';

            for (var key in this.searchValues)
            {
                var li = "<li class='list-group-item'> ";

                li += "<div class='dropdown dropdown-classic fixed-field'> ";
                li += "<div class='dropdown-toggle' data-toggle='dropdown'> ";
                li += this.searchValues[key].name;
                li += "<b class='caret'></b> ";
                li += "</div> ";
                li += "<ul class='dropdown-menu'> ";
                for (var choice in this.columns)
                {
                    li += "<li> ";
                    li += "<a class='searched-column' key='" + key + "'>" + this.columns[choice].name + "</a> ";
                    li += "</li> ";
                }
                li += "</ul> ";
                li += "</div> ";

                li += "<div class='dropdown dropdown-classic fixed-field'> ";
                li += "<div class='dropdown-toggle' data-toggle='dropdown'> ";
                li += this.searchValues[key].op;
                li += "<b class='caret'></b> ";
                li += "</div> ";
                li += "<ul id='rule" + key + "' class='dropdown-menu'> ";

                var column = this.getColumn(this.searchValues[key].name);
                for (var choice in column.searchoptions)
                {
                    li += "<li> ";
                    li += "<a class='rule' key='" + key + "'>" + this.rules[column.searchoptions[choice]] + "</a> ";
                    li += "</li> ";
                }
                li += "</ul> ";
                li += "</div> ";

                li += "<input type='text' key='" + key + "' class='search-field fixed-field' value='" + this.searchValues[key].data + "'> ";

                li += "<button type='submit' key='" + key + "' class='delete-rule-btn btn btn-warning btn-xs'>Delete rule</button> ";
                li += "</li> ";

                html += li;
            }

            $('#search-rules').html(html);
            $('.searched-column').click(function () {
                var key = $(this).attr('key');
                var name = $(this).text();
                searcher.changeColumn(name, key);
                searcher.saveData();
                searcher.renderButtons();
            });

            $('.rule').click(function () {
                var key = $(this).attr('key');
                var operator = $(this).text();
                searcher.changeStringRule(operator, key);
                searcher.saveData();
                searcher.renderButtons();
            });

            $('.search-field').change(function () {
                var key = $(this).attr('key');
                var data = $(this).val();
                searcher.searchValues[key].data = data;
                searcher.saveData();
            });

            $('.delete-rule-btn').click(function () {
                var key = $(this).attr('key');
                searcher.deleteRule(key);
                searcher.saveData();
                searcher.renderButtons();
            });
        },
        renderButtons1: function ()
        {
            var html = '';

            for (var key in this.searchValues)
            {
                var li = "<li class='list-group-item'> ";

                li += "<div class='inline' style='width: 250px;margin-right:5px;'>";
                li += "<select class='column-select2' key='" + key + "' style='width: 100%' >";

                var selected = this.searchValues[key].name;
                for (var choice in this.columns)
                {
                    li += "<option class='searched-column'";

                    if (selected === this.columns[choice].name)
                        li += " selected = 'selected' ";

                    li += ">" + this.columns[choice].name + "</option> ";
                }
                li += "</select></div>";


                li += "<div class='inline' style='width: 250px;margin-right:5px;'>";
                li += "<select class='rule-select2' key='" + key + "' style='width: 100%' >";
                var column = this.getColumn(this.searchValues[key].name);
                selected = this.searchValues[key].op;
                for (var choice in column.searchoptions)
                {
                    var value = this.rules[column.searchoptions[choice]];

                    li += "<option class='rule'";

                    if (selected === value)
                        li += " selected = 'selected' ";

                    li += " >" + value + "</option> ";
                }
                li += "</select></div>";


                li += "<input type='text' key='" + key + "' class='search-field form-control fixed-field inline' value='" + this.searchValues[key].data + "'> ";

                li += "<button type='submit' key='" + key + "' class='delete-rule-btn btn btn-warning btn-xs'>Delete rule</button> ";
                li += "</li> ";

                html += li;
            }

            $('#search-rules').html(html);

            //initializeSelect2();
            $('.column-select2').select2({
                minimumResultsForSearch: Infinity
            });

            $('.column-select2').on("change", function (e)
            {
                var key = $(e.currentTarget).attr('key');
                var name = e.val;
                searcher.changeColumn(name, key);
                searcher.saveData();
                searcher.renderButtons1();
            });

            $('.rule-select2').select2({
                minimumResultsForSearch: Infinity
            });


            $('.rule-select2').on("change", function (e)
            {
                var key = $(e.currentTarget).attr('key');
                var operator = e.val;
                searcher.changeStringRule(operator, key);
                searcher.saveData();
                searcher.renderButtons1();
            });

            $('.search-field').change(function () {
                var key = $(this).attr('key');
                var data = $(this).val();
                searcher.searchValues[key].data = data;
                searcher.saveData();
            });

            $('.delete-rule-btn').click(function () {
                var key = $(this).attr('key');
                searcher.deleteRule(key);
                searcher.saveData();
                searcher.renderButtons1();
            });

            $("#selected-category").select2("val", this.selectedCategory);
        }
    };

// searcher end

    searcher.storedData = searcher.loadData();

    if (typeof (searcher.storedData) === 'undefined') {
        searcher.searchValues = {};
        searcher.searchValuesLength = 0;
    }
    else {
        searcher.selectedCategory = searcher.storedData.selected;
        if (searcher.storedData.selected === "Human gene")
            searcher.columns = searcher.humanColumns;

        if (searcher.storedData.selected === "Fly gene")
            searcher.columns = searcher.flyColumns;

        searcher.searchValues = searcher.storedData.data;


        var max = 0;
        for (var value in searcher.searchValues) {
            if (value > max)
                max = value;
        }

        searcher.searchValuesLength = max + 1;

        searcher.renderButtons1();
    }

// searcher initialization end
    
});

// document ready end
