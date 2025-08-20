const BASEURL = window.location.href;
const form = document.querySelector("form");
const clearBtn = document.getElementById("clear");
const subtotalDisplay = document.getElementById("subtotal");
const pajakDisplay = document.getElementById("pajak");
const totalDisplay = document.getElementById("total");
const daftar_belanja = document.getElementById("daftar-belanja");
const kategori_menu = document.querySelectorAll(".kategori-menu");
const panelDetail = document.getElementById("panel-detail");
const showPanelBtn = document.getElementById("show-panel");
let selected_menu = [];

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".menu").forEach((menu) => {
        menu.addEventListener("click", () => {
            const displayAmount = menu.querySelector("span.amount");
            const tersedia = JSON.parse(menu.dataset.tersedia);
            const id = parseInt(menu.dataset.id);
            const harga = parseInt(menu.dataset.harga);
            const nama = menu.dataset.nama;

            if (tersedia) {
                const find = selected_menu.find((index) => {
                    return index.nama == nama && !index.take_away;
                });
                if (!find) {
                    addList(nama, harga, id, false);
                    displayAmount.classList.remove("d-none");
                    displayAmount.value = 1;
                } else {
                    const amount = find.element.querySelector("input.amount");
                    amount.value = parseInt(amount.value) + 1;
                    displayAmount.querySelector("b").innerHTML = amount.value;
                }
                refreshAmountEvent();
            } else {
                alert("Menu telah habis!");
            }
        });
    });

    document.querySelectorAll(".menu .take-away").forEach((take_away) => {
        take_away.addEventListener("click", (e) => {
            e.stopPropagation();

            const menu = take_away.closest(".menu");
            const tersedia = JSON.parse(menu.dataset.tersedia);
            const id = parseInt(menu.dataset.id);
            const harga = parseInt(menu.dataset.harga);
            const nama = menu.dataset.nama;

            if (tersedia) {
                const find = selected_menu.find((index) => {
                    return index.nama == nama && index.take_away;
                });
                if (!find) {
                    addList(nama, harga, id, true);
                    take_away.querySelector("b").innerHTML = 1;
                } else {
                    const amount = find.element.querySelector("input.amount");
                    amount.value = parseInt(amount.value) + 1;
                    take_away.querySelector("b").innerHTML = amount.value;
                }
                refreshAmountEvent();
            } else {
                alert("Menu telah habis!");
            }
        });
    });

    clearBtn.addEventListener("click", () => {
        if (
            daftar_belanja.childElementCount &&
            confirm("Apakah anda yakin ingin membersihkan daftar belanja?")
        ) {
            clearList();
        }
    });

    document.querySelectorAll(".filter-kategori").forEach((btn) => {
        btn.addEventListener("change", () => {
            if (btn.checked) {
                let filter = btn.dataset.kategori;
                switch (filter) {
                    case "semua":
                        kategori_menu.forEach((kategori) =>
                            toggleDisplay(kategori, true)
                        );
                        break;
                    default:
                        kategori_menu.forEach((kategori) =>
                            toggleDisplay(kategori, false)
                        );
                        toggleDisplay(
                            document.querySelector(`.kategori-menu.${filter}`),
                            true
                        );
                        break;
                }
            }
        });
    });

    document.querySelector(".submit-form").addEventListener("click", () => {
        if (document.querySelectorAll(".item").length) {
            if (!form.checkValidity()) {
                alert("Silahkan cek kembali!");
            } else if (confirm("Apakah anda yakin ingin memproses data ini?")) {
                form.submit();
            }
        } else {
            alert("Daftar belanja kosong!");
        }
    });

    showPanelBtn.addEventListener("click", () => {
        panelDetail.classList.toggle("active");
    });
});

function toggleDisplay(element, bool) {
    if (bool) {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
}

function addList(nama, harga, id, take_away) {
    let item = document.createElement("div");
    item.setAttribute("class", "row g-2");

    item.dataset.id = id;
    item.dataset.nama = nama;
    item.dataset.harga = harga;

    item.innerHTML = `
        <div class="col-5">
            <input type="hidden" name="id[]" value="${id}">
            <div class="input-group mb-3">
                <button class="btn btn-icon btn-danger m-0 removeList" type="button">
                    <i class="fa fa-xmark"></i>
                </button>
                <input type="text" class="item form-control form-control-solid ps-3" name="item[]" value="${nama}" readonly>
            </div>
        </div>
        <div class="col-2">
            <input type="number" class="amount form-control form-control-solid ps-2" name="amount[]" value="1" min="1">
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <span class="input input-group-text border-0">Rp. </span>
                <input type="number" class="subtotal form-control form-control-solid ps-2" name="item_subtotal[]" value="${harga}" readonly>
            </div>
        </div>`;

    daftar_belanja.appendChild(item);

    selected_menu.push({
        nama: nama,
        take_away: take_away,
        element: item,
    });

    refreshAmountEvent();

    document.querySelectorAll(".tooltips").forEach((element) => {
        $(element).tooltip("dispose");
        $(element).tooltip();
    });
}

function removeList(button) {
    let item = button.closest(".row");
    let findIndex = selected_menu.findIndex((index) => {
        return (
            index.nama == item.dataset.nama &&
            index.take_away == JSON.parse(item.dataset.take_away)
        );
    });

    selected_menu.splice(findIndex, 1);

    if (JSON.parse(item.dataset.take_away)) {
        document.querySelector(
            `.menu[data-nama="${item.dataset.nama}"] .take-away b`
        ).innerHTML = "";
    } else {
        document
            .querySelector(`.menu[data-nama="${item.dataset.nama}"] .amount`)
            .classList.add("d-none");
    }

    item.remove();
    refreshAmountEvent();
}

function clearList() {
    form.reset();
    selected_menu = [];
    daftar_belanja.innerHTML = "";
    document
        .querySelectorAll(`.menu .amount`)
        .forEach((e) => e.classList.add("d-none"));
    document
        .querySelectorAll(`.menu .take-away b`)
        .forEach((e) => (e.innerHTML = ""));
    refreshAmountEvent();
}

function refreshAmountEvent() {
    const allAmountInput = document.querySelectorAll("input.amount");
    const allDeleteBtn = document.querySelectorAll("button.removeList");

    if (selected_menu.length) {
        allAmountInput.forEach((amount) => {
            let parent = amount.closest(".row");
            let menu = document.querySelector(
                `.menu[data-id="${parent.dataset.id}"]`
            );
            countSubtotalItem(parent);

            amount.onchange = () => {
                if (JSON.parse(parent.dataset.take_away)) {
                    menu.querySelector("span.take-away b").innerHTML =
                        amount.value;
                } else {
                    menu.querySelector("span.amount b").innerHTML =
                        amount.value;
                }

                countSubtotalItem(parent);
                countTotal();
            };
        });

        allDeleteBtn.forEach((btn) => {
            btn.onclick = () => {
                removeList(btn);
            };
        });

        if (window.innerWidth >= 992)
            allAmountInput[allAmountInput.length - 1].focus();
        countTotal();
    }
}

function countSubtotalItem(item) {
    const amount = item.querySelector("input.amount");
    const subtotal = item.querySelector("input.subtotal");
    subtotal.value = parseInt(amount.value) * parseInt(item.dataset.harga);
}

function countTotal() {
    subtotalDisplay.value = 0;
    document.querySelectorAll("input.subtotal").forEach((subtotal) => {
        subtotalDisplay.value =
            parseInt(subtotalDisplay.value) + parseInt(subtotal.value);
    });

    pajakDisplay.value =
        parseInt(subtotalDisplay.value) *
        (parseInt(pajakDisplay.dataset.pajak) / 100);

    totalDisplay.value =
        parseInt(subtotalDisplay.value) + parseInt(pajakDisplay.value);
}
