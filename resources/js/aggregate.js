const aggregateSalesData = (data) => {
  const aggregated = {};

  data.forEach(data => {
    if (!aggregated[data.sale_date]) {
      aggregated[data.sale_date] = {
        sale_date: data.sale_date,
        temperature: 0,
        weather: 0,
        totalSales: 0,
        totalCosts: 0
      };
    }

    aggregated[data.sale_date].sale_date = data.sale_date;
    aggregated[data.sale_date].totalSales += parseInt(data.sales);
    aggregated[data.sale_date].totalCosts += parseInt(data.costs);
    aggregated[data.sale_date].temperature = parseInt(data.temperature);
    aggregated[data.sale_date].weather = parseInt(data.weather);
  });

  return Object.values(aggregated);
}

export { aggregateSalesData }