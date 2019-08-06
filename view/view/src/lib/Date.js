import moment from 'moment'


export const dateToMin = date => moment(date).format('DD-MM-YYYY HH:mm a')
export const dateToHour = date => moment(date).format('DD-MM-YYYY HH a')
export const dateToDay = date => moment(date).format('YYYY-MM-DD')
export const dateToWeek = date => moment(date).format('GGGG-[W]WW')
export const dateToMonth = date => moment(date).format('MMM YYYY')
export const dateToYear = date => moment(date).format('YYYY')
export const dateBeautify = date => moment(date).format('Do MMMM YYYY')

export const removeDuplicate = (a, b) => {
  if (a.indexOf(b) < 0) {
      a.push(b)
  }
  return a
}

export const groupData = (data, sensor, dateFormatter) => {
  // Find unique dates

  return data.reduce((date,current) => {
    if (date.indexOf(dateFormatter(current.dateTime)) < 0) {
      date.push(dateFormatter(current.dateTime))
    }
    return date

  }, [])
  .map((date) => {
      return {
        date: date,
        result: data.filter(el => dateFormatter(el.dateTime) === date)
          .map(el => {
            if(sensor == 1){
              return el.sensor1Value
            } 
            if(sensor == 2){
              return el.sensor2Value
            } 
            if(sensor == 3){
              return el.sensor3Value
            } 
            if(sensor == 4){
              return el.sensor4Value
            }
          })
          .reduce((total, value, index, array) => {
            total = parseInt(total) + parseInt(value)

            if( index == array.length-1) { 
              return parseInt(total)/array.length;
            }else { 
              return parseInt(total);
            }
          } )
      }
    })
    .map(element => element.result)
}