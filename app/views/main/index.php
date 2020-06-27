<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<?php require APPROOT . '/views/_includes/_header.php'; ?>

<body>

    <div class="overallCover">
        <div class="selectionItemCover">
            <form action="<?php echo URLROOT; ?>/main/getJson" method="post">
                <input type="hidden" name="data_json" value="" id="data_json">
                <input type="submit" value="JSON" name="getjson" class="selectionItem noOutline">
            </form>
            <form action="<?php echo URLROOT; ?>/main/getYaml" method="post">
                <input type="hidden" name="data_yaml" value="" id="data_yaml">
                <input type="submit" value="YAML" name="getyaml" class="selectionItem noOutline">
            </form>
            <form action="<?php echo URLROOT; ?>/main/getCsv" method="post">
                <input type="hidden" name="data_csv" value="" id="data_csv">
                <input type="submit" value="CSV" name="getcsv" class="selectionItem noOutline">
            </form>
        </div>
        <div class="customTableCover">
            <div class="customTableInnerCover">
                <table class="customTable" id="table1">
                </table>
            </div>
            <div class="selector" onclick="showModal('uploadModal_upload')">
                <img src="<?php echo URLROOT ?>/img/upload.svg" alt="">
            </div>
            <div class="commonModal" id="commonModal">
                <div class="uploadModalBack" onclick="" id="uploadModalBack"></div>
                <div class="uploadModal" id="uploadModal_upload">
                    <span class="uploadModalClose" onclick="hideModal()">X</span>
                    <form action="<?php echo URLROOT; ?>/" method="post" enctype="multipart/form-data" class="fileSubmitForm">
                        <input type="file" name="upload" id="fileToUpload" class="fileSubmitForm_item">
                        <input type="submit" value="Upload Code" name="submit" class="fileSubmitForm_item fileSubmitForm_item-btn">
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script type='text/javascript'>
        var js_data = [];
        <?php
        if (count($data["data"]) > 0) {
            $final_data = $data["data"];
            $final_data_encoded = json_encode($final_data);
            echo "js_data = " . $final_data_encoded . ";\n";
        } else {
            echo "js_data = [];\n";
        }
        ?>


        tableCreate(JSON.parse(js_data[0]['d_json']), 'table1');

        document.getElementById('data_json').value = js_data[0]['d_json'];
        document.getElementById('data_yaml').value = js_data[0]['d_yaml'];
        document.getElementById('data_csv').value = js_data[0]['d_csv'];

        function tableCreate(data, table_id) {
            var xtable = document.getElementById(table_id);
            xtable.innerHTML = "";
            var thead = document.createElement('thead');
            var thead_tr = document.createElement('tr');
            var tbody = document.createElement('tbody');

            for (var h_key in data[0]) {
                var thead_tr_th = document.createElement('th');
                thead_tr_th.classList.add("centerHeader");
                thead_tr_th.innerHTML = h_key;
                thead_tr.appendChild(thead_tr_th);
            }
            thead.appendChild(thead_tr);

            for (var key1 in data) {
                var tbody_tr = document.createElement('tr');
                for (var key2 in data[key1]) {
                    var tbody_tr_td = document.createElement('td');
                    tbody_tr_td.innerHTML = data[key1][key2];
                    tbody_tr.appendChild(tbody_tr_td);
                }
                tbody.appendChild(tbody_tr);
            }

            xtable.appendChild(thead);
            xtable.appendChild(tbody);
        }
    </script>

    <script src="<?php echo URLROOT ?>/js/jquery.js" type="text/javascript"></script>

    <script src="<?php echo URLROOT ?>/js/script.js" type="text/javascript"></script>

</body>

</html>