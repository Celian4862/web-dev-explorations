let sum = 0;
let error = document.getElementById("error");
function add(id1, id2, value) {
    let a = document.getElementById(id1);
    let b = document.getElementById(id2);
    a.classList.add('hidden');
    b.classList.remove('hidden');
    sum += parseInt(value);
    document.getElementById("sum").value = sum;
    error.innerHTML = "";
}
function remove(id1, id2, value) {
    let a = document.getElementById(id1), b = document.getElementById(id2);
    a.classList.remove('hidden');
    b.classList.add('hidden');
    sum -= parseInt(value);
    document.getElementById("sum").value = sum;
    error.innerHTML = "";
}
function tender() {
    let cash = parseInt(document.getElementById("cash").value), buyList = document.getElementById("buy"), buyItems = buyList.getElementsByTagName("li"), buyItemsHidden = buyList.getElementsByClassName("hidden"), change = document.getElementById("change");
    if (buyItems.length == 0) {
        change.innerHTML = "";
        error.innerHTML = "There are no more products that you can buy.";
    } else if (!sum) {
        change.innerHTML = "";
        error.innerHTML = "Please add a product.";
    } else if (isNaN(cash)) {
        change.innerHTML = "";
        error.innerHTML = "Please enter how much money you're giving.";
    } else if (cash < sum) {
        change.innerHTML = "";
        error.innerHTML = "Insufficient cash!";
    } else {
        error.innerHTML = "";
        change.innerHTML = "Change is: " + (cash - sum);
        let i = 0;
        while (buyItems.length > 0) {
            if (!(buyItems[i].classList.contains("hidden"))) {
                buyItems[i].remove();
            } else {
                i++;
            }
        }
        document.getElementById("sum").value = 0;
        sum = 0;
        document.getElementById("cash").value = 0;    
    }
}