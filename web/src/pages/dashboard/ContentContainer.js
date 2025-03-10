// ContentContainer.js
import React from "react";

const ContentContainer = ({ isExpanded, children }) => {
  return (
    <div style={{ marginLeft: isExpanded ? 240 : 64, transition: 'margin 0.2s' }} className='flex-content'>
      {children}
    </div>
  );
};

export default ContentContainer;
