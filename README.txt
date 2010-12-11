
embedded versions of coverFlow apps

ContentFlow, version 1.0.2
ImageFlow version 1.3.0
MooFlow version 0.2.1

Changed sources:

ImageFlow:
- res/ImageFlow/imageflow.js duplictated as res/imageflow_modified.js
  - to extract 'domReady(function()..)
  - to change reflectionPath img src, which need to redirect like ../../../..

!!! MooFlow:
- res/MooFlow/MooFlow.css
  because of some customer behaviors