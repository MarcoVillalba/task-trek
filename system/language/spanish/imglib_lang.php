<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['imglib_source_image_required'] = 'Debe especificar una imagen de origen en sus preferencias.';
$lang['imglib_gd_required'] = 'La biblioteca de imágenes GD es necesaria para esta función';
$lang['imglib_gd_required_for_props'] = 'Su servidor debe admitir la biblioteca de imágenes GD para determinar las propiedades de la imagen.';
$lang['imglib_unsupported_imagecreate'] = 'Su servidor no admite la función GD requerida para procesar este tipo de imagen.';
$lang['imglib_gif_not_supported'] = 'Las imágenes GIF a menudo no son compatibles debido a restricciones de licencia. Puede que tenga que usar imágenes JPG o PNG en su lugar. ';
$lang['imglib_jpg_not_supported'] = 'Las imágenes JPG no son compatibles';
$lang['imglib_png_not_supported'] = 'Las imágenes PNG no son compatibles';
$lang['imglib_jpg_or_png_required'] = 'El protocolo de cambio de tamaño de imagen especificado en sus preferencias solo funciona con tipos de imagen JPEG o PNG.';
$lang['imglib_copy_error'] = 'Se encontró un error al intentar reemplazar el archivo. Asegúrese de que su directorio de archivos sea editable. ';
$lang['imglib_rotate_unsupported'] = 'La rotación de la imagen no parece ser compatible con su servidor.';
$lang['imglib_libpath_invalid'] = 'La ruta a su biblioteca de imágenes no es correcta. Establezca la ruta correcta en sus preferencias de imagen. ';
$lang['imglib_image_process_failed'] = 'Error al procesar la imagen. Verifique que su servidor sea compatible con el protocolo elegido y que la ruta a su biblioteca de imágenes sea correcta. ';
$lang['imglib_rotation_angle_required'] = 'Se requiere un ángulo de rotación para rotar la imagen.';
$lang['imglib_invalid_path'] = 'La ruta a la imagen no es correcta.';
$lang['imglib_invalid_image'] = 'La imagen proporcionada no es válida';
$lang['imglib_copy_failed'] = 'La rutina de copia de la imagen falló';
$lang['imglib_missing_font'] = 'No se puede encontrar una fuente para usar.';
$lang['imglib_save_failed'] = 'No se puede guardar la imagen. Asegúrese de que la imagen y el directorio de archivos sean editables. ';
