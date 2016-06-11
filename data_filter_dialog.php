<script>
    function onEnable() {
        window.protein_type = $('[name="proteinType"]').val();

        //console.log(protein_type)
        if (protein_type == "Membrane") {
            $('[name="nonmembraneType"]').attr("disabled", true);
            $('[name="membraneType"]').removeAttr("disabled");
        }
        else if (protein_type == "Secreted") {
            $('[name="membraneType"]').attr("disabled", true);
            $('[name="nonmembraneType"]').removeAttr("disabled");
        }
        else if (protein_type == "All") {
            // $('[name="membraneType"]').removeAttr("disabled");
            // $('[name="nonmembraneType"]').removeAttr("disabled");
            $('[name="membraneType"]').attr("disabled", true);
            $('[name="nonmembraneType"]').attr("disabled", true);
        }
    }

    function generate() {

        sessionStorage.setItem("taxonomic_lineage", getFilterData("taxonomy"));
        sessionStorage.setItem("protein_type", getFilterData("proteinType"));
        sessionStorage.setItem("membrane_type", getFilterData("membraneType"));
        sessionStorage.setItem("nonmembrane_type", getFilterData("nonmembraneType"));
        sessionStorage.setItem("evidence", getFilterData("evidenceLevel"));
        sessionStorage.setItem("peptide", getFilterData("peptide"));

        window.location = "/signal-peptide/entries2.php";
    }

    function getFilterData(name) {
        if (name == "peptide") {
            var filter_value = $('input[name="peptide"]:checked').val();
            var filter_text = filter_value;
            data = {filter_value: filter_value, filter_text: filter_text};
            return JSON.stringify(data);
        } else {
            var selector_value = '[name="' + name + '"]';
            var selector_text = '[name="' + name + '"] :selected';
            var filter_value = $(selector_value).val();
            var filter_text = $(selector_text).text();
            if (filter_value == "" || filter_value == "None" ||
                $(selector_value).prop('disabled')) {
                filter_value = "None";
                filter_text = "None";
            }
            data = {filter_value: filter_value, filter_text: filter_text};
            return JSON.stringify(data);
        }
    }
</script>
<div class="bs-examples">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-primary ">Data Filter</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group"> <!-- style="display:none;"> -->
                            <label for="recipient-name" class="control-label">Signal Peptide:</label>
                            <div class="radio">
                                <label><input type="radio" name="peptide" value="Yes" id="testyes" checked="checked">Yes</label>
                                <label><input type="radio" name="peptide" value="No">No</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Taxonomy:</label>
                            <select class="form-control" name="taxonomy">
                                <!--<option value="None">-Select-</option>-->
                                <option value="All">All</option>
                                <option value="Archaea">Archaea</option>
                                <option value="Bacteria">Bacteria</option>
                                <option value="Eukaryota">Eukaryote</option>
                                <option value="Viruses">Viruses</option>
                                <!--<option value="Others">Others</option>-->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Protein Type:</label>
                            <select class="form-control" name="proteinType" onClick="onEnable()">
                                <!--<option value="None">-Select-</option>-->
                                <option value="All">All</option>
                                <option value="Membrane">Transmembrane</option>
                                <option value="Secreted">Non-Transmembrane</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="recipient-name" class="control-label">Membrane Type:</label>
                            <!--<select class="form-control" name="membraneType" id="memType">-->
                            <select class="form-control" name="membraneType" disabled="disabled">
                                <!--<option value="None">-Select-</option>-->
                                <option value="All">All</option>
                                <option value="Single-pass">Single Spanning Transmembrane</option>
                                <option value="Multi-pass">Multi Spanning Transmembrane</option>
                                <option value="Beta-barrel">Beta-barrel Transmembrane</option>
                                <!--<option value="Others">Others</option>-->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Non-Membrane Type:</label>
                            <select class="form-control" name="nonmembraneType" disabled="disabled">
                                <!--<option value="None">-Select-</option>-->
                                <option value="All">All</option>
                                <option value="Secretory">Secretory</option>
                                <option value="Non-secretory">Non-Secretory</option>
                                <!--<option value="Others">Others</option>-->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Evidence Level:</label>
                            <select class="form-control" name="evidenceLevel">
                                <!--<option value="None">-Select-</option>-->
                                <option value="All">All</option>
                                <!--<option value="Qualified">Qualifed Experimental Entries</option>-->
                                <option value="Qualified">Experimental Entries</option>
                                <!--<option value="Unqualified">Unqualified Experimental Entries</option>-->
                                <option value="Non-experimental">Non-experimental Entries</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="generatePeptide" onclick="generate()">Generate</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
            </div>
        </div>
    </div>
</div>
