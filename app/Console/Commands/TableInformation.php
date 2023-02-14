<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;

class TableInformation{
    protected $tableName;
    protected $schema;
    protected $relations = [];

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->schema = DB::getDoctrineSchemaManager();
    }

    public function columns()
    {
        // return DB::getSchemaBuilder()->getColumnListing($this->tableName);
        $table = $this->schema->listTableDetails($this->tableName);
        $columns = $table->getColumns();
        $result = [];
        foreach ($columns as $column) {
            $columnData = [];
            $columnData['name'] = $column->getName();
            $columnData['type'] = $column->getType()->getName();
            $columnData['not_null'] = $column->getNotnull();
            $columnData['primary_key'] = $table->hasPrimaryKey() && $table->getPrimaryKey()->getColumns()[0] == $column->getName();
            $columnData['auto_increment'] = $column->getAutoincrement();
            $columnData['comment'] = $column->getComment();
            $columnData['default'] = $column->getDefault();
            $columnData['unique'] = false;

            $indexes = $table->getIndexes();
            foreach ($indexes as $index) {
                if (!in_array($column->getName(), $index->getColumns())) {
                    continue;
                }

                $columnData['index']['key'] = $index->getName();
                $columnData['index']['is_unique'] = $index->isUnique();
                if ($index->isUnique()) {
                    $columnData['unique'] = true;
                }
            }

            if (!isset($columnData['index'])) {
                $columnData['index'] = null;
            }

            $foreignKeys = $table->getForeignKeys();
            foreach ($foreignKeys as $foreignKey) {
                if (!in_array($column->getName(), $foreignKey->getLocalColumns())) {
                    continue;
                }

                $columnData['foreign']['key'] = $foreignKey->getName();
                $columnData['foreign']['referenced_table'] = $foreignKey->getForeignTableName();
                $columnData['foreign']['referenced_column'] = $foreignKey->getForeignColumns()[0];
                // $columnData['foreign']['on_update'] = $foreignKey->onUpdate();
                // $columnData['foreign']['on_delete'] = $foreignKey->onDelete();
            }

            if (!isset($columnData['foreign'])) {
                $columnData['foreign'] = null;
            }

            $result[] = $columnData;
        }
        return $result;
    }

    public function foreigns()
    {
        $table = $this->schema->listTableDetails($this->tableName);
        $foreignKeys = $table->getForeignKeys();
        $result = [];
        foreach ($foreignKeys as $foreignKey) {
            $foreignData = [];
            $foreignData['local_column'] = $foreignKey->getLocalColumns()[0];
            $foreignData['referenced_table'] = $foreignKey->getForeignTableName();
            $foreignData['referenced_column'] = $foreignKey->getForeignColumns()[0];
            // $foreignData['on_update'] = $foreignKey->getOption("onUpdate");
            // $foreignData['on_delete'] = $foreignKey->getOption("onDelete");

            $result[] = $foreignData;
        }
        return $result;
    }

    public function indexes()
    {
        $table = $this->schema->listTableDetails($this->tableName);
        $indexes = $table->getIndexes();
        $result = [];
        foreach ($indexes as $index) {
            $indexData = [];
            $indexData['name'] = $index->getName();
            $indexData['columns'] = $index->getColumns();
            $indexData['unique'] = $index->isUnique();

            $result[] = $indexData;
        }
        return $result;
    }

    public function references()
    {
        $result = [];
        foreach ($this->schema->listTableNames() as $otherTable) {
            $otherTable = $this->schema->listTableDetails($otherTable);
            foreach ($otherTable->getForeignKeys() as $foreignKey) {
                if ($foreignKey->getForeignTableName() != $this->tableName) {
                    continue;
                }

                $referenceData = [];
                $referenceData['referencing_table'] = $otherTable->getName();
                $referenceData['local_column'] = $foreignKey->getForeignColumns()[0];
                $referenceData['referenced_table'] = $foreignKey->getLocalTableName();
                $referenceData['referenced_column'] = $foreignKey->getLocalColumns()[0];
                $referenceData['key_name'] = $foreignKey->getName();

                $result[] = $referenceData;
            }
        }
        return $result;
    }

    public function relations()
    {
        $table = $this->schema->listTableDetails($this->tableName);

        $this->getOneToOneRelations($table);
        $this->getOneToManyRelations($table);
        $this->getManyToManyRelations($table);
        $this->getBelongsToRelations($table);

        $this->getPolymorphicOneToOneRelations($table);
        $this->getPolymorphicOneToManyRelations($table);
        $this->getPolymorphicManyToManyRelations($table);

        return $this->relations;
    }

    private function getOneToOneRelations($table)
    {
        $references = $this->references();
        foreach ($references as $reference) {
            if ($reference['referenced_table'] != $table->getName()) {
                continue;
            }
            $this->relations[] = [
                'relation' => 'hasOne',
                'table' => $reference['referencing_table'],
                'local_column' => $reference['referenced_column'],
                'related_column' => $reference['local_column']
            ];
        }
    }

    public function getOneToManyRelations($table)
    {
        foreach ($table->getForeignKeys() as $foreignKey) {
            $referencedTable = $this->schema->listTableDetails($foreignKey->getForeignTableName());
            if ($referencedTable->hasForeignKey($table->getName())) {
                continue;
            }

            $relationData = [];
            $relationData['relation'] = 'OneToMany';
            $relationData['local_table'] = $table->getName();
            $relationData['local_column'] = $foreignKey->getLocalColumns()[0];
            $relationData['referenced_table'] = $referencedTable->getName();
            $relationData['referenced_column'] = $foreignKey->getForeignColumns()[0];
            $relationData['key_name'] = $foreignKey->getName();

            $this->relations[] = $relationData;
        }
    }

    private function getManyToManyRelations($table)
    {
        $relations = [];
        $tables = $this->schema->listTableNames();
        foreach ($tables as $otherTable) {
            if ($otherTable == $this->tableName) {
                continue;
            }

            $otherTable = $this->schema->listTableDetails($otherTable);
            $foreignKeys = $otherTable->getForeignKeys();
            foreach ($foreignKeys as $foreignKey) {
                if ($foreignKey->getForeignTableName() != $this->tableName) {
                    continue;
                }

                $relatedTable = $this->schema->listTableDetails($foreignKey->getLocalTableName());
                $relatedForeignKeys = $relatedTable->getForeignKeys();
                foreach ($relatedForeignKeys as $relatedForeignKey) {
                    if ($relatedForeignKey->getForeignTableName() != $this->tableName) {
                        continue;
                    }

                    $relation = [];
                    $relation['table'] = $otherTable->getName();
                    $relation['related_table'] = $relatedTable->getName();
                    $relation['key'] = $foreignKey->getName();
                    $relation['related_key'] = $relatedForeignKey->getName();

                    $relations[] = $relation;
                }
            }
        }

        $this->relations['many_to_many'] = $relations;
    }

    protected function getBelongsToRelations($table)
    {
        $relations = [];

        $belongsToForeignKeys = $table->getForeignKeys();
        foreach ($belongsToForeignKeys as $foreignKey) {
            $relation = [];
            $relation['local_column'] = $foreignKey->getLocalColumns()[0];
            $relation['referenced_table'] = $foreignKey->getForeignTableName();
            $relation['referenced_column'] = $foreignKey->getForeignColumns()[0];
            $relation['relation_type'] = 'belongsTo';
            $relations[] = $relation;
        }

        $this->relations = array_merge($this->relations, $relations);
    }

    private function isPolymorphic(array $reference)
    {
        $referencingTable = $reference['referencing_table'];
        $referencedTable = $reference['referenced_table'];
        $localColumn = $reference['local_column'];
        $referencedColumn = $reference['referenced_column'];

        $referencingTableDetails = $this->schema->listTableDetails($referencingTable);
        $referencedTableDetails = $this->schema->listTableDetails($referencedTable);

        $referencingColumns = $referencingTableDetails->getColumns();
        $referencedColumns = $referencedTableDetails->getColumns();

        $referencingColumn = $referencingColumns[$localColumn];
        $referencedColumn = $referencedColumns[$referencedColumn];

        return $referencingColumn->getType()->getName() === 'integer'
            && $referencedColumn->getType()->getName() === 'integer'
            && strpos($localColumn, '_id') !== false
            && strpos($referencedColumn->getName(), '_id') !== false;
    }

    private function getPolymorphicOneToOneRelations($table)
    {
        $references = $this->references();
        foreach ($references as $reference) {
            if (!$this->isPolymorphic($reference)) {
                continue;
            }

            $relation = [
                'type' => 'polymorphic_one_to_one',
                'referencing_table' => $reference['referencing_table'],
                'local_column' => $reference['local_column'],
                'referenced_table' => $reference['referenced_table'],
                'referenced_column' => $reference['referenced_column'],
                'key_name' => $reference['key_name']
            ];
            $this->relations[] = $relation;
        }
    }

    private function getPolymorphicOneToManyRelations($table)
    {
        $references = $this->references();
        foreach ($references as $reference) {
            if (!$this->isPolymorphic($reference)) {
                continue;
            }

            $relation = [
                'type' => 'polymorphic_one_to_many',
                'referencing_table' => $reference['referencing_table'],
                'local_column' => $reference['local_column'],
                'referenced_table' => $reference['referenced_table'],
                'referenced_column' => $reference['referenced_column'],
                'key_name' => $reference['key_name']
            ];
            $this->relations[] = $relation;
        }
    }

    private function getPolymorphicManyToManyRelations($table)
    {
        $references = $this->references();
        foreach ($references as $reference) {
            if (!$this->isPolymorphic($reference)) {
                continue;
            }

            $relation = [
                'type' => 'polymorphic_many_to_many',
                'referencing_table' => $reference['referencing_table'],
                'local_column' => $reference['local_column'],
                'referenced_table' => $reference['referenced_table'],
                'referenced_column' => $reference['referenced_column'],
                'key_name' => $reference['key_name'],
                'intermediate_table' => $reference['intermediate_table'],
                'intermediate_column_local' => $reference['intermediate_column_local'],
                'intermediate_column_referenced' => $reference['intermediate_column_referenced'],
            ];
            $this->relations[] = $relation;
        }
    }

    // protected function getOneToOneRelations($table)
    // {
    //     foreach ($table->getForeignKeys() as $key) {
    //         $referencedTable = $key->getForeignTableName();
    //         $columnName = $key->getLocalColumns()[0];
    //         $referencedColumn = $key->getForeignColumns()[0];

    //         if ($this->isOneToOneRelation($table, $referencedTable, $columnName, $referencedColumn)) {
    //             $this->relations[$table->getName()]['One To One'][] = [
    //                 'related_table' => $referencedTable,
    //                 'relation_column' => $columnName,
    //                 'referenced_column' => $referencedColumn
    //             ];
    //         }
    //     }
    // }

    // protected function getOneToManyRelations($table)
    // {
    //     foreach ($this->schema->listTableDetails() as $relatedTable) {
    //         if ($relatedTable->getName() === $table->getName()) {
    //             continue;
    //         }

    //         foreach ($relatedTable->getForeignKeys() as $key) {
    //             $referencedTable = $key->getForeignTableName();
    //             $columnName = $key->getLocalColumns()[0];
    //             $referencedColumn = $key->getForeignColumns()[0];

    //             if ($referencedTable === $table->getName() && ! $this->isOneToOneRelation($relatedTable, $referencedTable, $columnName, $referencedColumn)) {
    //                 $this->relations[$relatedTable->getName()]['One To Many'][] = [
    //                     'related_table' => $referencedTable,
    //                     'relation_column' => $columnName,
    //                     'referenced_column' => $referencedColumn
    //                 ];
    //             }
    //         }
    //     }
    // }

    // protected function getManyToManyRelations($table)
    // {
    //     foreach ($this->schema->listTableDetails() as $relatedTable) {
    //         foreach ($relatedTable->getForeignKeys() as $key) {
    //             $referencedTable = $key->getForeignTableName();
    //             $columnName = $key->getLocalColumns()[0];
    //             $referencedColumn = $key->getForeignColumns()[0];

    //             if ($referencedTable === $table->getName() && ! $this->isOneToOneRelation($relatedTable, $referencedTable, $columnName, $referencedColumn)) {
    //                 $this->relations[$relatedTable->getName()]['Many To Many'][] = [
    //                     'related_table' => $referencedTable,
    //                     'relation_column' => $columnName,
    //                     'referenced_column' => $referencedColumn
    //                 ];
    //             }
    //         }
    //     }
    // }

    // protected function getBelongsToRelations($table)
    // {
    //     foreach ($this->schema->listTableDetails() as $relatedTable) {
    //         if ($relatedTable->getName() === $table->getName()) {
    //             continue;
    //         }

    //         foreach ($table->getForeignKeys() as $key) {
    //             $referencedTable = $key->getForeignTableName();
    //             $columnName = $key->getLocalColumns()[0];
    //             $referencedColumn = $key->getForeignColumns()[0];

    //             if ($referencedTable === $relatedTable->getName()) {
    //                 $this->relations[$table->getName()]['Belongs To'][] = [
    //                     'related_table' => $referencedTable,
    //                     'relation_column' => $columnName,
    //                     'referenced_column' => $referencedColumn
    //                 ];
    //             }
    //         }
    //     }
    // }

    // protected function getPolymorphicOneToOneRelations($table)
    // {
    //     foreach ($table->getForeignKeys() as $key) {
    //         $referencedTable = $key->getForeignTableName();
    //         $columnName = $key->getLocalColumns()[0];
    //         $referencedColumn = $key->getForeignColumns()[0];

    //         if ($this->isPolymorphicOneToOneRelation($table, $referencedTable, $columnName, $referencedColumn)) {
    //             $this->relations[$table->getName()]['Polymorphic One To One'][] = [
    //                 'related_table' => $referencedTable,
    //                 'relation_column' => $columnName,
    //                 'referenced_column' => $referencedColumn
    //             ];
    //         }
    //     }
    // }

    // protected function getPolymorphicOneToManyRelations($table)
    // {
    //     foreach ($this->schema->listTableDetails() as $relatedTable) {
    //         if ($relatedTable->getName() === $table->getName()) {
    //             continue;
    //         }

    //         foreach ($relatedTable->getForeignKeys() as $key) {
    //             $referencedTable = $key->getForeignTableName();
    //             $columnName = $key->getLocalColumns()[0];
    //             $referencedColumn = $key->getForeignColumns()[0];

    //             if ($referencedTable === $table->getName() && $this->isPolymorphicOneToOneRelation($relatedTable, $referencedTable, $columnName, $referencedColumn)) {
    //                 $this->relations[$relatedTable->getName()]['Polymorphic One To Many'][] = [
    //                     'related_table' => $referencedTable,
    //                     'relation_column' => $columnName,
    //                     'referenced_column' => $referencedColumn
    //                 ];
    //             }
    //         }
    //     }
    // }

    // protected function getPolymorphicManyToManyRelations($table)
    // {
    //     foreach ($this->schema->listTableDetails() as $relatedTable) {
    //         if ($relatedTable->getName() === $table->getName()) {
    //             continue;
    //         }

    //         foreach ($relatedTable->getForeignKeys() as $key) {
    //             $referencedTable = $key->getForeignTableName();
    //             $columnName = $key->getLocalColumns()[0];
    //             $referencedColumn = $key->getForeignColumns()[0];

    //             if ($referencedTable === $table->getName() && $this->isPolymorphicOneToOneRelation($relatedTable, $referencedTable, $columnName, $referencedColumn)) {
    //                 $this->relations[$relatedTable->getName()]['Polymorphic Many To Many'][] = [
    //                     'related_table' => $referencedTable,
    //                     'column_name' => $columnName,
    //                     'referenced_column' => $referencedColumn,
    //                 ];
    //             }
    //         }
    //     }
    // }

    // protected function isOneToOneRelation($table, $referencedTable, $columnName, $referencedColumn)
    // {
    //     return $this->schema->listTableDetails($referencedTable)->hasIndex([$referencedColumn])
    //         && $table->hasIndex([$columnName]);
    // }

    // protected function isPolymorphicOneToOneRelation($table, $referencedTable, $columnName, $referencedColumn)
    // {
    //     $relatedTable = $this->schema->listTableDetails($referencedTable);

    //     // check if there are two foreign keys pointing to the same table
    //     if (count($relatedTable->getForeignKeys()) == 2) {
    //         // check if one of the foreign keys references the current table
    //         foreach ($relatedTable->getForeignKeys() as $relatedKey) {
    //             if ($relatedKey->getForeignTableName() == $table->getName()) {
    //                 // check if the columns have the same names
    //                 if ($relatedKey->getLocalColumns()[0] == $referencedColumn
    //                     && $relatedKey->getForeignColumns()[0] == $columnName) {
    //                     return true;
    //                 }
    //             }
    //         }
    //     }

    //     return false;
    // }
}
