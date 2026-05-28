<?php
function read_docx($filename){
    $content = '';
    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $xml = $zip->getFromName('word/document.xml');
        $zip->close();
        
        $dom = new DOMDocument();
        $dom->loadXML($xml, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
        $paragraphs = $dom->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'p');
        foreach ($paragraphs as $p) {
            $texts = $p->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 't');
            $p_text = '';
            foreach ($texts as $t) {
                $p_text .= $t->nodeValue;
            }
            if (!empty($p_text)) {
                $content .= $p_text . "\n";
            }
        }
    } else {
        return "Failed to open ZIP";
    }
    return $content;
}

echo "=== TASK 1 ===\n";
echo read_docx("TASK 1 UPDATE FITUR (BAYU).docx");
echo "\n=== FITUR 2 ===\n";
echo read_docx("FITUR 2 BAYU.docx");
echo "\n=== FITUR 3 ===\n";
echo read_docx("FITUR 3 BAYU.docx");
