import React, { useState } from 'react';

const StorageSpaceEditor = () => {
  const [gridSize, setGridSize] = useState({ width: 20, height: 10 });
  const [storageSpaces, setStorageSpaces] = useState([]);
  const [isDragging, setIsDragging] = useState(false);
  const [dragStart, setDragStart] = useState(null);
  const [currentDrag, setCurrentDrag] = useState(null);
  const [isPlacingStorage, setIsPlacingStorage] = useState(false);
  const [selectedSpace, setSelectedSpace] = useState(null);

  const CELL_SIZE = 40;
  
  const roomWidth = gridSize.width * CELL_SIZE;
  const roomHeight = gridSize.height * CELL_SIZE;

  const getGridCoordinates = (e) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const scaleX = gridSize.width * CELL_SIZE / rect.width;
    const scaleY = gridSize.height * CELL_SIZE / rect.height;
    
    const x = Math.floor((e.clientX - rect.left) * scaleX / CELL_SIZE);
    const y = Math.floor((e.clientY - rect.top) * scaleY / CELL_SIZE);
    
    return {
      x: Math.max(0, Math.min(x, gridSize.width - 1)),
      y: Math.max(0, Math.min(y, gridSize.height - 1))
    };
  };

  const handleMouseDown = (e) => {
    if (!isPlacingStorage) return;
    setIsDragging(true);
    const coords = getGridCoordinates(e);
    setDragStart(coords);
    setCurrentDrag(coords);
  };

  const handleMouseMove = (e) => {
    if (!isDragging) return;
    const coords = getGridCoordinates(e);
    setCurrentDrag(coords);
  };

  const handleMouseUp = () => {
    if (isDragging && dragStart && currentDrag) {
      const x1 = Math.min(dragStart.x, currentDrag.x);
      const y1 = Math.min(dragStart.y, currentDrag.y);
      const x2 = Math.max(dragStart.x, currentDrag.x);
      const y2 = Math.max(dragStart.y, currentDrag.y);

      const hasOverlap = storageSpaces.some(space => {
        return !(x2 < space.x || x1 > (space.x + space.width - 1) ||
                y2 < space.y || y1 > (space.y + space.height - 1));
      });

      if (!hasOverlap) {
        setStorageSpaces([...storageSpaces, {
          id: Date.now(),
          x: x1,
          y: y1,
          width: x2 - x1 + 1,
          height: y2 - y1 + 1,
          number: ''
        }]);
      }
    }
    setIsDragging(false);
    setDragStart(null);
    setCurrentDrag(null);
  };

  const handleStorageClick = (space) => {
    if (!isPlacingStorage) {
      setSelectedSpace(space);
    }
  };

  const handleNumberChange = (spaceId, newNumber) => {
    const updatedSpaces = storageSpaces.map(space => 
      space.id === spaceId 
        ? { ...space, number: newNumber }
        : space
    );
    setStorageSpaces(updatedSpaces);
    
    const updatedSpace = updatedSpaces.find(space => space.id === spaceId);
    setSelectedSpace(updatedSpace);
  };

  const handleDelete = (spaceId) => {
    setStorageSpaces(storageSpaces.filter(space => space.id !== spaceId));
    setSelectedSpace(null);
  };

  const handleComplete = () => {
    setSelectedSpace(null);
  };

  return (
    <div className="p-4">
      <h1 className="text-2xl mb-4">部屋のレイアウト設定</h1>
      
      <div className="mb-4 space-y-2">
        <div className="flex gap-4 items-center">
          <div>
            <label className="block text-sm">部屋の幅 (m):</label>
            <input
              type="number"
              value={gridSize.width}
              onChange={(e) => setGridSize(prev => ({ ...prev, width: Math.max(1, parseInt(e.target.value) || 1) }))}
              className="border p-1 w-24"
            />
          </div>
          <div>
            <label className="block text-sm">奥行き (m):</label>
            <input
              type="number"
              value={gridSize.height}
              onChange={(e) => setGridSize(prev => ({ ...prev, height: Math.max(1, parseInt(e.target.value) || 1) }))}
              className="border p-1 w-24"
            />
          </div>
        </div>

        <div className="flex gap-2">
          <button
            onClick={() => {
              setIsPlacingStorage(!isPlacingStorage);
              setSelectedSpace(null);
            }}
            className={`px-4 py-2 rounded ${
              isPlacingStorage
                ? 'bg-blue-500 text-white'
                : 'bg-blue-500 text-white'
            }`}
          >
            荷物置き場を追加
          </button>
          
          {isPlacingStorage && (
            <button
              onClick={() => setIsPlacingStorage(false)}
              className="px-4 py-2 bg-green-500 text-white rounded"
            >
              配置完了
            </button>
          )}
        </div>

        {isPlacingStorage ? (
          <p className="text-sm text-gray-600">
            ドラッグして荷物置き場のサイズを指定してください
          </p>
        ) : (
          <p className="text-sm text-gray-600">
            荷物置き場をクリックして番号を設定できます
          </p>
        )}
      </div>

      <div className="flex gap-4">
        <div className="overflow-auto border border-gray-300 rounded">
          <div 
            className="relative select-none"
            style={{
              width: `${roomWidth}px`,
              height: `${roomHeight}px`
            }}
            onMouseDown={handleMouseDown}
            onMouseMove={handleMouseMove}
            onMouseUp={handleMouseUp}
            onMouseLeave={handleMouseUp}
          >
            <div
              className="absolute inset-0"
              style={{
                display: 'grid',
                gridTemplateColumns: `repeat(${gridSize.width}, ${CELL_SIZE}px)`,
                gridTemplateRows: `repeat(${gridSize.height}, ${CELL_SIZE}px)`
              }}
            >
              {Array.from({ length: gridSize.width * gridSize.height }).map((_, i) => (
                <div key={i} className="border border-gray-100" />
              ))}
            </div>

            {storageSpaces.map(space => (
              <div
                key={space.id}
                onClick={() => handleStorageClick(space)}
                className={`absolute border-2 bg-opacity-75 cursor-pointer hover:opacity-100 ${
                  selectedSpace?.id === space.id 
                    ? 'border-red-500 bg-red-200' 
                    : 'border-blue-500 bg-blue-200'
                }`}
                style={{
                  left: `${space.x * CELL_SIZE}px`,
                  top: `${space.y * CELL_SIZE}px`,
                  width: `${space.width * CELL_SIZE}px`,
                  height: `${space.height * CELL_SIZE}px`
                }}
              >
                <div className="text-xs p-1">
                  {space.number || '番号未設定'}
                  <br />
                  {space.width}m × {space.height}m
                </div>
              </div>
            ))}

            {isDragging && dragStart && currentDrag && (
              <div
                className="absolute border-2 border-green-500 bg-green-200 opacity-50"
                style={{
                  left: `${Math.min(dragStart.x, currentDrag.x) * CELL_SIZE}px`,
                  top: `${Math.min(dragStart.y, currentDrag.y) * CELL_SIZE}px`,
                  width: `${(Math.abs(currentDrag.x - dragStart.x) + 1) * CELL_SIZE}px`,
                  height: `${(Math.abs(currentDrag.y - dragStart.y) + 1) * CELL_SIZE}px`
                }}
              />
            )}
          </div>
        </div>

        {selectedSpace && (
          <div className="w-64 p-4 border rounded-lg bg-white shadow-sm">
            <h3 className="font-bold mb-4">荷物置き場の設定</h3>
            <div className="space-y-4">
              <div>
                <label className="block text-sm mb-1">番号:</label>
                <input
                  type="text"
                  value={selectedSpace.number || ''}
                  onChange={(e) => handleNumberChange(selectedSpace.id, e.target.value)}
                  className="border p-2 w-full rounded"
                  placeholder="例：A-1"
                />
              </div>
              <div>
                <p className="text-sm">サイズ: {selectedSpace.width}m × {selectedSpace.height}m</p>
              </div>
              <div className="flex gap-2">
                <button
                  onClick={() => handleDelete(selectedSpace.id)}
                  className="px-4 py-2 bg-red-500 text-white rounded w-1/2"
                >
                  削除
                </button>
                <button
                  onClick={handleComplete}
                  className="px-4 py-2 bg-green-500 text-white rounded w-1/2"
                >
                  完了
                </button>
              </div>
            </div>
          </div>
        )}
      </div>

      <div className="mt-4 text-sm text-gray-600">
        配置済み荷物置き場: {storageSpaces.length}個
      </div>
    </div>
  );
};

export default StorageSpaceEditor;