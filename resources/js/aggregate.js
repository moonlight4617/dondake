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
    aggregated[data.sale_date].totalSales += data.sales ? parseInt(data.sales) : 0;
    aggregated[data.sale_date].totalCosts += data.costs ? parseInt(data.costs) : 0;
    aggregated[data.sale_date].temperature = data.temperature ? parseInt(data.temperature) : 0;
    aggregated[data.sale_date].weather = data.weather ? parseInt(data.weather) : 0;
  });

  return Object.values(aggregated);
}

export { aggregateSalesData }