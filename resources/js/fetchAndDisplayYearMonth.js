import axios from 'axios';
const now = new Date();

const getDataPerMonth = async (year, month) => {
  try {
    const response = await axios.get("/api/analysis/", {
      params: {
        targetYear: year,
        targetMonth: month,
      }
    });
    return response.data.data
  } catch (e) {
    console.log(e)
  }
}

const previousMonth = (year, month) => {
  if (month != 1)
    month -= 1
  else {
    month = 12
    year -= 1
  }
  // 表示年月が今月以降であれば、翌月への移動できなくする
  const displayFlag = new Date(year, month) >= now ? false : true
  return { displayFlag, year, month }

}

const nextMonth = (year, month) => {
  if (new Date(year, month) >= now)
    return
  if (month != 12)
    month += 1
  else {
    month = 1
    year += 1
  }
  const displayFlag = new Date(year, month) >= now ? false : true
  return { displayFlag, year, month }
}


export { getDataPerMonth, previousMonth, nextMonth }