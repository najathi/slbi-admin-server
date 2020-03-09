//Total Tax[YQ, YR, Tax - 3, Tax - 4]
function calc(obj) {
  var basicc = 0;
  var yq = 0;
  var yr = 0;
  var tax_3 = 0;
  var tax_4 = 0;
  var total_tax = 0;
  var supp_charge = 0;
  var service_amt = 0;
  var net_profit = 0;
  var net_due = 0;
  var net_to_supplier = 0;

  var e = obj.id.toString();

  if (e == 'basicc') {
    basicc = Number(obj.value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'yq') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(obj.value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'yr') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(obj.value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'tax_3') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(obj.value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'tax_4') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(obj.value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'total_tax') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(obj.value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'supp_charge') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(obj.value);
    service_amt = Number(document.getElementById('service_amt').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'service_amt') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(obj.value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'net_profit') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('net_profit').value);
    net_profit = Number(obj.value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'net_due') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('net_profit').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(obj.value);
    net_to_supplier = Number(document.getElementById('net_to_supplier').value);
  }
  else if (e == 'net_to_supplier') {
    basicc = Number(document.getElementById('basicc').value);
    yq = Number(document.getElementById('yq').value);
    yr = Number(document.getElementById('yr').value);
    tax_3 = Number(document.getElementById('tax_3').value);
    tax_4 = Number(document.getElementById('tax_4').value);
    total_tax = Number(document.getElementById('total_tax').value);
    supp_charge = Number(document.getElementById('supp_charge').value);
    service_amt = Number(document.getElementById('net_profit').value);
    net_profit = Number(document.getElementById('net_profit').value);
    net_due = Number(document.getElementById('net_due').value);
    net_to_supplier = Number(obj.value);
  }

  // Total Tax
  total_tax = yq + yr + tax_3 + tax_4;
  document.getElementById('total_tax').value = total_tax.toFixed(2);

  // Net to Supply (Basic + all taxes + Supp Charge = (Net to Supp))
  net_to_supplier = basicc + (yq + yr + tax_3 + tax_4) + supp_charge;
  document.getElementById('net_to_supplier').value = net_to_supplier.toFixed(2);

  // Basic + all taxes + Supp charge + Service amt = (Net Due)
  net_due = basicc + (yq + yr + tax_3 + tax_4) + supp_charge + service_amt;
  document.getElementById('net_due').value = net_due.toFixed(2);

  // Net Due - Net to Supp = (Net Earning / Net Profit)
  net_profit = net_due - net_to_supplier;
  document.getElementById('net_profit').value = net_profit.toFixed(2);

}