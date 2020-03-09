let viewPass = [];
let viewFromT = [];
let viewDepart = [];
let viewTicketNo = [];
let viewTotalF = [];

let passArr = document.getElementsByName('p_name[]');

let row;
let cell;

function viewData() {

    let table = document.getElementById('viewPassTable').getElementsByTagName('tbody')[0];

    for (let i = 0; i < passArr.length; i++) {

        row = table.insertRow(i);

        viewPass[i] = document.getElementById('p_name' + i).value;
        viewFromT[i] = document.getElementById('from_to' + i).value;
        viewDepart[i] = document.getElementById('depart_date' + i).value;
        viewTicketNo[i] = document.getElementById('ticket_no' + i).value;
        viewTotalF[i] = document.getElementById('net_due' + i).value;

        cell = row.insertCell(0);
        cell.innerHTML = viewTotalF[i];

        cell = row.insertCell(0);
        cell.innerHTML = viewTicketNo[i];

        cell = row.insertCell(0);
        cell.innerHTML = viewFromT[i];

        cell = row.insertCell(0);
        cell.innerHTML = viewDepart[i];

        cell = row.insertCell(0);
        cell.innerHTML = viewPass[i];

    }

}
