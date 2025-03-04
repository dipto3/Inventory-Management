<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function insertData(Request $request)
    {
        $tables = [
            'products'                           => [
                'test' => 'integer,nullable,0'
            ],

        ];

        foreach ($tables as $table => $columns) {
            if (! Schema::hasTable($table)) {
                Schema::create($table, function (Blueprint $tableSchema) use ($columns) {
                    $tableSchema->id();
                    foreach ($columns as $column => $type) {
                        $columnType = $type;
                        $modifier   = null;

                        if (strpos($type, ',') !== false) {
                            [$columnType, $modifier] = explode(',', $type);
                            $columnType              = trim($columnType);
                            $modifier                = trim($modifier);
                        }

                        // Apply nullable or default modifier once
                        $isNullable   = $modifier === 'nullable';
                        $defaultValue = ($modifier !== 'nullable' && $modifier !== null) ? $modifier : null;

                        switch ($columnType) {
                            case 'integer':
                                $column = $tableSchema->integer($column);
                                break;
                            case 'double':
                                $column = $tableSchema->double($column);
                                break;
                            case 'date':
                                $column = $tableSchema->date($column);
                                break;
                            case 'time':
                                $column = $tableSchema->time($column);
                                break;
                            case 'text':
                                $column = $tableSchema->text($column);
                                break;
                            case 'string':
                                $column = $tableSchema->string($column);
                                break;
                            case 'bool':
                                $column = $tableSchema->boolean($column);
                                break;
                            case 'json':
                                $column = $tableSchema->json($column);
                                break;
                            case 'decimal':
                                $column = $tableSchema->decimal($column);
                                break;
                            case 'longtext':
                                $column = $tableSchema->longText($column);
                                break;
                            case 'datetime':
                                $column = $tableSchema->dateTime($column);
                                break;
                            default:
                                throw new \Exception("Unsupported column type: $columnType");
                        }

                        if ($isNullable) {
                            $column->nullable();
                        }
                        if ($defaultValue !== null) {
                            $column->default($defaultValue);
                        }
                    }
                    $tableSchema->timestamps();
                });
            } else {
                $this->checkAndAddColumns($table, $columns);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Columns created or updated successfully!',
        ]);
    }

    private function checkAndAddColumns($table, $columns)
    {
        Schema::table($table, function (Blueprint $tableSchema) use ($table, $columns) {
            foreach ($columns as $column => $type) {
                $columnType = $type;
                $modifier   = null;

                if (strpos($type, ',') !== false) {
                    [$columnType, $modifier] = explode(',', $type);
                    $columnType              = trim($columnType);
                    $modifier                = trim($modifier);
                }
                $isNullable   = $modifier === 'nullable';
                $defaultValue = ($modifier !== 'nullable' && $modifier !== null) ? $modifier : null;

                if (! Schema::hasColumn($table, $column)) {
                    switch ($columnType) {
                        case 'integer':
                            $column = $tableSchema->integer($column);
                            break;
                        case 'double':
                            $column = $tableSchema->double($column);
                            break;
                        case 'date':
                            $column = $tableSchema->date($column);
                            break;
                        case 'time':
                            $column = $tableSchema->time($column);
                            break;
                        case 'text':
                            $column = $tableSchema->text($column);
                            break;
                        case 'string':
                            $column = $tableSchema->string($column);
                            break;
                        case 'bool':
                            $column = $tableSchema->boolean($column);
                            break;
                        case 'json':
                            $column = $tableSchema->json($column);
                            break;
                        case 'decimal':
                            $column = $tableSchema->decimal($column);
                            break;
                        case 'longtext':
                            $column = $tableSchema->longText($column);
                            break;
                        case 'datetime':
                            $column = $tableSchema->dateTime($column);
                            break;
                        default:
                            throw new \Exception("Unsupported column type: $columnType");
                    }

                    if ($isNullable) {
                        $column->nullable();
                    }
                    if ($defaultValue !== null) {
                        $column->default($defaultValue);
                    }
                }
            }
        });
    }

    private function addColumnToTable(Blueprint $tableSchema, $table, $column, $type)
    {
        if (strpos($type, ',') !== false) {
            [$columnType, $modifier] = explode(',', $type);
            $columnType              = trim($columnType);
            $modifier                = trim($modifier);
        } else {
            $columnType = $type;
            $modifier   = null;
        }

        if (! Schema::hasColumn($table, $column)) {
            switch ($columnType) {
                case 'integer':
                    $columnInstance = $tableSchema->integer($column);
                    break;
                case 'date':
                    $columnInstance = $tableSchema->date($column);
                    break;
                case 'time':
                    $columnInstance = $tableSchema->time($column);
                    break;
                case 'text':
                    $columnInstance = $tableSchema->text($column);
                    break;
                case 'string':
                    $columnInstance = $tableSchema->string($column);
                    break;
                case 'bool':
                    $columnInstance = $tableSchema->bool($column);
                    break;
                case 'json':
                    $columnInstance = $tableSchema->json($column);
                    break;
                case 'decimal':
                    $columnInstance = $tableSchema->decimal($column);
                    break;
                default:
                    throw new \Exception("Unsupported column type: $columnType");
            }

            if ($modifier === 'nullable') {
                $columnInstance->nullable();
            } elseif ($modifier !== null) {
                $columnInstance->default($modifier);
            }
        }
    }
}
