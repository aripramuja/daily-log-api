<?php
namespace App\Repositories;

use App\Models\Position;

class PositionRepository {
    public function getAllPosition() {
        return Position::all();
    }

    public function getPositionById($id) {
        return Position::find($id);
    }

    public function createPosition($data) {
        return Position::create([
            'parent_id' => $data["parent_id"],
            'position' => $data["position"],
            'org_unit' => $data["org_unit"],
            'level' => $data["level"],
        ]);
    }

    public function updatePosition($data) {
        return Position::find($data->id)->update([
            'parent_id' => $data->parent_id,
            'position' => $data->position,
            'org_unit' => $data->org_unit,
            'level' => $data->level,
        ]);
    }

    public function deletePosition($id) {
        return Position::find($id)->delete();
    }
}
