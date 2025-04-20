<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->get('path', '');
        $search = $request->get('search', '');
        $basePath = base_path('public/documentos');
        $fullPath = $basePath . ($path ? '/' . $path : '');

        if (!File::exists($fullPath)) {
            return redirect()->route('documents')->with('error', 'La ruta especificada no existe.');
        }

        $items = [];
        
        // Si hay una búsqueda, buscar en todo el directorio
        if ($search) {
            $items = $this->searchInDirectory($basePath, $search);
        } else {
            // Si no hay búsqueda, mostrar solo el contenido del directorio actual
            $directories = File::directories($fullPath);
            $files = File::files($fullPath);

            foreach ($directories as $directory) {
                $items[] = [
                    'name' => basename($directory),
                    'type' => 'directory',
                    'path' => $path ? $path . '/' . basename($directory) : basename($directory),
                    'size' => $this->formatSize($this->getDirectorySize($directory)),
                    'modified' => date('Y-m-d H:i:s', File::lastModified($directory)),
                    'folder' => $path ?: 'Documentos'
                ];
            }

            foreach ($files as $file) {
                $items[] = [
                    'name' => $file->getFilename(),
                    'type' => 'file',
                    'path' => $path ? $path . '/' . $file->getFilename() : $file->getFilename(),
                    'size' => $this->formatSize($file->getSize()),
                    'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                    'folder' => $path ?: 'Documentos'
                ];
            }
        }

        return view('documents.index', [
            'items' => $items,
            'currentPath' => $path,
            'breadcrumbs' => $this->getBreadcrumbs($path),
            'search' => $search
        ]);
    }

    private function searchInDirectory($directory, $search)
    {
        $items = [];
        $searchTerms = explode(' ', strtolower($search));

        // Buscar en el directorio actual
        $directories = File::directories($directory);
        $files = File::files($directory);

        foreach ($directories as $dir) {
            $dirName = basename($dir);
            $dirNameLower = strtolower($dirName);
            
            // Verificar si el directorio coincide con la búsqueda
            $matches = true;
            foreach ($searchTerms as $term) {
                if (strpos($dirNameLower, $term) === false) {
                    $matches = false;
                    break;
                }
            }

            if ($matches) {
                $relativePath = str_replace(base_path('public/documentos/'), '', $dir);
                $items[] = [
                    'name' => $dirName,
                    'type' => 'directory',
                    'path' => $relativePath,
                    'size' => $this->formatSize($this->getDirectorySize($dir)),
                    'modified' => date('Y-m-d H:i:s', File::lastModified($dir)),
                    'folder' => basename(dirname($relativePath)) ?: 'Documentos'
                ];
            }

            // Buscar recursivamente en subdirectorios
            $items = array_merge($items, $this->searchInDirectory($dir, $search));
        }

        foreach ($files as $file) {
            $fileName = $file->getFilename();
            $fileNameLower = strtolower($fileName);
            
            // Verificar si el archivo coincide con la búsqueda
            $matches = true;
            foreach ($searchTerms as $term) {
                if (strpos($fileNameLower, $term) === false) {
                    $matches = false;
                    break;
                }
            }

            if ($matches) {
                $relativePath = str_replace(base_path('public/documentos/'), '', $file->getPathname());
                $items[] = [
                    'name' => $fileName,
                    'type' => 'file',
                    'path' => $relativePath,
                    'size' => $this->formatSize($file->getSize()),
                    'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                    'folder' => basename(dirname($relativePath)) ?: 'Documentos'
                ];
            }
        }

        return $items;
    }

    private function getDirectorySize($path)
    {
        $size = 0;
        foreach (File::allFiles($path) as $file) {
            $size += $file->getSize();
        }
        return $size;
    }

    private function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, 2) . ' ' . $units[$pow];
    }

    private function getBreadcrumbs($path)
    {
        $breadcrumbs = [['name' => 'Documentos', 'path' => '']];
        if ($path) {
            $parts = explode('/', $path);
            $currentPath = '';
            foreach ($parts as $part) {
                $currentPath .= ($currentPath ? '/' : '') . $part;
                $breadcrumbs[] = ['name' => $part, 'path' => $currentPath];
            }
        }
        return $breadcrumbs;
    }
} 