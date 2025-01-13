import React from 'react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const AdminDashboard = () => {
  return (
    <div className="min-h-screen bg-gray-50">
      {/* Navigation */}
      <nav className="bg-white shadow-md">
        <div className="max-w-7xl mx-auto px-4">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center">
              <span className="text-2xl font-bold text-purple-600">YouDemy</span>
            </div>
            <div className="flex items-center space-x-4">
              <span className="text-gray-600">Admin Panel</span>
              <button className="text-gray-600 hover:text-gray-900">Logout</button>
            </div>
          </div>
        </div>
      </nav>

      {/* Main Content */}
      <div className="p-8 max-w-7xl mx-auto">
        <h1 className="text-2xl font-bold mb-8">Statistics Overview</h1>
        
        {/* Stats Grid */}
        <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <Card>
            <CardHeader className="pb-2">
              <CardTitle className="text-sm text-gray-500">Total Users</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-3xl font-bold">15,234</p>
            </CardContent>
          </Card>
          <Card>
            <CardHeader className="pb-2">
              <CardTitle className="text-sm text-gray-500">Total Courses</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-3xl font-bold">456</p>
            </CardContent>
          </Card>
          <Card>
            <CardHeader className="pb-2">
              <CardTitle className="text-sm text-gray-500">Total Revenue</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-3xl font-bold">$123,456</p>
            </CardContent>
          </Card>
          <Card>
            <CardHeader className="pb-2">
              <CardTitle className="text-sm text-gray-500">Active Instructors</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-3xl font-bold">89</p>
            </CardContent>
          </Card>
        </div>

        {/* Recent Users Table */}
        <Card className="mb-8">
          <CardHeader>
            <CardTitle>Recent Users</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead>
                  <tr className="text-left text-gray-500">
                    <th className="pb-4">User</th>
                    <th className="pb-4">Role</th>
                    <th className="pb-4">Joined</th>
                    <th className="pb-4">Status</th>
                    <th className="pb-4">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr className="border-b">
                    <td className="py-4">John Smith</td>
                    <td>Student</td>
                    <td>2 hours ago</td>
                    <td>
                      <span className="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">
                        Active
                      </span>
                    </td>
                    <td>
                      <button className="text-blue-600 hover:text-blue-800">Edit</button>
                    </td>
                  </tr>
                  <tr className="border-b">
                    <td className="py-4">Sarah Johnson</td>
                    <td>Instructor</td>
                    <td>1 day ago</td>
                    <td>
                      <span className="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">
                        Active
                      </span>
                    </td>
                    <td>
                      <button className="text-blue-600 hover:text-blue-800">Edit</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </CardContent>
        </Card>

        {/* Recent Reports */}
        <Card>
          <CardHeader>
            <CardTitle>Recent Reports</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              <div className="flex items-center justify-between border-b pb-4">
                <div>
                  <p className="font-semibold">Content Report</p>
                  <p className="text-gray-500">Report on "JavaScript Basics" course</p>
                </div>
                <div className="flex items-center space-x-2">
                  <button className="bg-red-100 text-red-600 px-3 py-1 rounded-md">
                    Review
                  </button>
                  <span className="text-gray-400">2 hours ago</span>
                </div>
              </div>
              <div className="flex items-center justify-between">
                <div>
                  <p className="font-semibold">Payment Issue</p>
                  <p className="text-gray-500">Failed payment for course enrollment</p>
                </div>
                <div className="flex items-center space-x-2">
                  <button className="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-md">
                    Pending
                  </button>
                  <span className="text-gray-400">5 hours ago</span>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
};

export default AdminDashboard;