document.addEventListener('DOMContentLoaded', function() {
    let fileContent = "";
    document.getElementById('submit-form__form_create').addEventListener('click', function(event) {
        let filteredArray = [];

        const file = document.getElementById('fileUpload__form_create').files[0];
        if (!file) {
            alert("Nie wybrano pliku.");
            return;
        }

        const allowedExtensions = ["csv", "xls", "xlsx"];
        const fileExtension = file.name.split(".").pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            alert("Niewłaściwy typ pliku. Proszę wybrać plik CSV, XLS lub XLSX.");
            return;
        }

        document.querySelector(".output_form").innerHTML = "<div id='spinner' class='spinner'></div>";

        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (fileExtension !== "csv") {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: "array" });
                const firstSheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[firstSheetName];
                fileContent = XLSX.utils.sheet_to_csv(worksheet);
            } else {
                fileContent = e.target.result;
            }

            fileContent = fileContent.replace(/\r/g, "");
            const fileArray = fileContent.split(/\n(?=(?:[^"]|"[^"]*")*$)/);

            let fileSeparator = "";
            let separatorRegex = "";
            let escapedSeparator = "";
            
            fileArray.forEach(function(element) {
                if (fileSeparator === "") {
                    const separators = [",", ";", "|", ":", "\t", " "];
                    let counts = {};
                    
                    separators.forEach(sep => {
                        counts[sep] = (element.match(new RegExp(`\\${sep}`, "g")) || []).length;
                    });

                    fileSeparator = Object.keys(counts).reduce((a, b) => counts[a] > counts[b] ? a : b);

                    if (fileSeparator === " ") {
                        let spaceAsSeparator = element.match(/ (\S+ )+/g);
                        if (!spaceAsSeparator) {
                            delete counts[" "];
                            fileSeparator = Object.keys(counts).reduce((a, b) => counts[a] > counts[b] ? a : b);
                        }
                    }
                    
                    escapedSeparator = fileSeparator.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
                    separatorRegex = new RegExp(`^[${escapedSeparator}]+$`);
                }
                    
                if (element.trim() !== "" && !separatorRegex.test(element)) {
                    let regex = new RegExp(escapedSeparator + "(?=(?:[^\"]|\"[^\"]*\")*$)");
                    let newElement = element.split(regex);

                    newElement = newElement.map(function(elem){
                        elem = elem.replace(/\\\\/g, '');
                        elem = elem.replace(/\\"/g, '');
                        elem = elem.replace(/"/g, '');
                        elem = elem.replace(/\t/g, ' ');
                        return elem;
                    });

                    filteredArray.push(newElement);
                }
            });

            const jsonDataArray = JSON.stringify(filteredArray);
            let byteLength = new TextEncoder().encode(jsonDataArray).length;

            if (byteLength > 500000) {
                document.querySelector(".output_form").innerHTML = "<p>Coś poszło nie tak<br><br>Za duży rozmiar pliku, popraw: <br>- max 4000 linijek,<br>- zapisz plik na komputerze w programie (openOffice, libreOffice) w formacie csv(utf8),<br>- jeżeli nie pomogło skontaktuj się z administratorem.</p>";
                document.getElementById("spinner").remove();
                return;
            }
            
            fetch(window.fileUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "qg58yn58q3yn5v",
                    "FileName": file.name.split(".")[0]
                },
                body: jsonDataArray
            })
            .then(response => {
                document.getElementById("spinner").remove();

                if (!response.ok) {
                    throw new Error("Błąd odpowiedzi serwera");
                }

                return response.json();
            })
            .then(report => {                
                if (report["status"] == "true" && window.location.hostname !== "mr.glasstec.pl") {
                    document.querySelector(".output_form").innerHTML = report["output"];

                    fetch("https://bdg.warsawexpo.eu/badgewp-reception.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: new URLSearchParams({
                            id_formularza: report["id_formularza"],
                            fair_name: report["fair_name"],
                            form_name: report["form_name"],
                            entries_count: report["entries_count"]
                        })
                    });
                }
            })
            .catch(error => {
                document.querySelector(".output_form").innerHTML = "<p>Coś poszło nie tak</p><br>" + error.message;
                console.error("Błąd:", error);
            });
        };
            
        if (fileExtension === "csv") {
            reader.readAsText(file);
        } else {
            reader.readAsArrayBuffer(file);
        }
    });
});