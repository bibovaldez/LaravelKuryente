// Fetch provinces and populate dropdown on page load
document.addEventListener("DOMContentLoaded", function () {
    fetchProvinces();
});
// Function to fetch provinces using AJAX
function fetchProvinces() {
    fetch("/address/provinces")
        .then((response) => response.json())
        .then((data) => {
            data.sort((a, b) => a.name.localeCompare(b.name));
            // Populate dropdown with province options
            const select = document.getElementById("provinceSelect");
            data.forEach((province) => {
                const option = document.createElement("option");
                option.value = province.name;
                option.text = province.name;
                option.setAttribute("data-code", province.code);
                select.appendChild(option);
            });
        })
        .catch((error) => console.error("Error fetching provinces:", error));
}
document
    .getElementById("provinceSelect")
    .addEventListener("change", function () {
        const selectedProvinceCode =
            this.options[this.selectedIndex].getAttribute("data-code");
        fetchMunicipalities(selectedProvinceCode);
    });

// Function to fetch municipalities using AJAX
function fetchMunicipalities(provinceCode) {
    fetch(`/address/provinces/${provinceCode}/municipalities`)
        .then((response) => response.json())
        .then((data) => {
            data.sort((a, b) => a.name.localeCompare(b.name));
            // Populate dropdown with municipality options
            const select = document.getElementById("municipalitySelect");
            select.innerHTML =
                '<option value="" disabled selected>Select Municipality</option>';
            data.forEach((municipality) => {
                const option = document.createElement("option");
                option.value = municipality.name;
                option.text = municipality.name;
                option.setAttribute("data-code", municipality.code);
                select.appendChild(option);
            });
        })
        .catch((error) =>
            console.error("Error fetching municipalities:", error)
        );
}
document
    .getElementById("municipalitySelect")
    .addEventListener("change", function () {
        const selectedMunicipalityCode =
            this.options[this.selectedIndex].getAttribute("data-code");
        fetchBarangay(selectedMunicipalityCode);
    });
// Function to fetch barangay using AJAX
function fetchBarangay(municipalityCode) {
    fetch(`/address/municipality/${municipalityCode}/barangays`)
        .then((response) => response.json())
        .then((data) => {
            data.sort((a, b) => a.name.localeCompare(b.name));
            // Populate dropdown with barangay options
            const select = document.getElementById("barangaySelect");
            select.innerHTML =
                '<option value="" disabled selected>Select Barangay</option>';
            data.forEach((barangay) => {
                const option = document.createElement("option");
                option.value = barangay.name;
                option.text = barangay.name;
                option.setAttribute("data-code", barangay.code);
                select.appendChild(option);
            });
        })
        .catch((error) => console.error("Error fetching barangays:", error));
}
document
    .getElementById("barangaySelect")
    .addEventListener("change", function () {
        const selectedBarangayCode =
            this.options[this.selectedIndex].getAttribute("data-code");
    });
