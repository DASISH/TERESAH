# =========
# Variabler
# =========

# Dokumentnamn
BOOK_NAME = TERESAH_user_manual

# XSLT templates with namespaces
XSLT_XHTML_TEMPLATE = docbook-xsl-ns-1.78.1/xhtml-1_1/docbook.xsl
XSLT_FO_TEMPLATE = docbook-xsl-ns-1.78.1/fo/docbook.xsl

# Kommandoradsargument
XSLT_PDF_ARGS = --stringparam paper.type A4 --stringparam fop1.extensions 1 --xinclude

# Gemensamma filer
NEEDED_FILES = index.xml

# =================================
# Docbook XML --> XHTML single page
# =================================

xhtml: $(BOOK_NAME).html

$(BOOK_NAME).html: $(NEEDED_FILES)
	xsltproc --xinclude --output $(BOOK_NAME).html $(XSLT_XHTML_TEMPLATE) index.xml 

# ==============
# XSL-FO --> PDF
# ==============

pdf: $(BOOK_NAME).pdf

$(BOOK_NAME).pdf: $(BOOK_NAME).fo $(NEEDED_FILES)
	fop -fo $(BOOK_NAME).fo -pdf $(BOOK_NAME).pdf

# ======================
# Docbooc XML --> XSL-FO
# ======================

$(BOOK_NAME).fo: $(NEEDED_FILES)
	xsltproc -o $(BOOK_NAME).fo \
	$(XSLT_PDF_ARGS) $(XSLT_FO_TEMPLATE) index.xml

# =======================
# Städa upp skapade filer
# =======================

.PHONY: clean
clean:
	rm *.html *.fo

.PHONY: superclean
superclean:
	rm *.html *.fo *.pdf
