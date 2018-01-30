import React from 'react'

const FileUpload = (props) => {
  return(
    <div>
      <input type="file" { ...props } />
    </div>
  )
}

export default FileUpload
