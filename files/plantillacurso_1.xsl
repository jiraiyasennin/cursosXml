<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
    <xsl:template match="cursos">
        <xsl:for-each select="curso[@categoria=php:function('categoria')]">
            <div class="card border text-justify">
                    <h2 class="card-title">Categoria:</h2><h3><xsl:value-of select="@categoria"/></h3>
                    <h3> Nombre: </h3><h5><xsl:value-of select="nombre"/></h5>
                    <h3>Duracion:</h3><p><xsl:value-of select="duracion"/></p>
                    <h4>Descripcion:</h4><p><xsl:value-of select="descripcion"/></p>
                    </div>
                    <hr/>
                </xsl:for-each>
            </xsl:template>
</xsl:stylesheet>